<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Mail;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class VoyagerUserController extends VoyagerBaseController
{
    /**
     * POST - Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Get input fields from request
        $data = $request->all();

        // Remove any roles that the user cannot assign
        if (!auth()->user()->hasPermission('assign_roles')) {
            unset($data['role_id']);
        }

        // Validate input fields
        $this->validateData($data);

        // Create a new user with the validated data
        $user = new User($data);

        // Generate a random password for the user
        $password = Str::random(8);
        $user->password = bcrypt($password);

        // Save the user to the database
        $user->save();

        // Assign the roles to the user
        if (isset($data['role_id'])) {
            $user->roles()->attach($data['role_id']);
        }

        // Send the user an email with their account details
        $this->sendAccountDetailsEmail($user, $password);

        // Redirect back to the index page with a success message
        return redirect()->route('voyager.users.index')->with([
            'message' => __('voyager::generic.successfully_added_new')." {$this->getDisplayName($user)}",
            'alert-type' => 'success',
        ]);
    }

    /**
     * PUT/PATCH - Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Get the user that we want to update
        $user = User::findOrFail($id);

        // Get input fields from request
        $data = $request->all();

        // Remove any roles that the user cannot assign
        if (!auth()->user()->hasPermission('assign_roles')) {
            unset($data['role_id']);
        }

        // Validate input fields
        $this->validateData($data, $user->id);

        // Update the user with the validated data
        $user->fill($data);

        // Save the updated user to the database
        $user->save();

        // Assign the roles to the user
        if (isset($data['role_id'])) {
            $user->roles()->sync($data['role_id']);
        } else {
            $user->roles()->detach();
        }

        // Redirect back to the index page with a success message
        return redirect()->route('voyager.users.index')->with([
            'message' => __('voyager::generic.successfully_updated')." {$this->getDisplayName($user)}",
            'alert-type' => 'success',
        ]);
    }

    /**
     * DELETE - Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Get the user that we want to delete
        $user = User::findOrFail($id);

        // Check if the user is the last admin user
        $lastAdminUser = User::role('admin')->count() === 1 && $user->hasRole('admin');

        if ($lastAdminUser) {
            // If this is the last admin user, don't delete the user and return an error message
            return redirect()->route('voyager.users.index')->with([
                'message' => __('voyager::generic.last_admin_cannot_be_deleted'),
                'alert-type' => 'error',
            ]);
        }

        // Delete the user from the database
        $user->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('voyager.users.index')->with([
            'message' => __('voyager::generic.successfully_deleted')." {$this->getDisplayName($user)}",
            'alert-type' => 'success',
        ]);
    }

            /**
             * Send an email to the user with their account details.
             *
             * @param  \App\Models\User  $user
             * @param  string  $password
             * @return void
             */
            protected function sendAccountDetailsEmail(User $user, $password)
            {
                // Send the user an email with their account details
                \Mail::to($user->email)->send(new \App\Mail\AccountDetails($user, $password));
            }

            /**
             * Validate the input data for creating or updating a user.
             *
             * @param  array  $data
             * @param  int|null  $id
             * @return void
             */
            protected function validateData(array $data, $id = null)
            {
                // Define the validation rules
                $rules = [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users,email'.($id ? ",$id" : ''),
                ];

                if ($id) {
                    // If updating the user, don't require a password if it wasn't entered
                    $rules['password'] = 'nullable|string|min:6|confirmed';
                } else {
                    // If creating a new user, require a password
                    $rules['password'] = 'required|string|min:6|confirmed';
                }

                if (auth()->user()->hasPermission('assign_roles')) {
                    // If the user can assign roles, require a role to be selected
                    $rules['role_id'] = 'required|exists:roles,id';
                }

                // Validate the input data
                $this->validate(request(), $rules);
            }

            /**
             * Get the display name for the specified user.
             *
             * @param  \App\Models\User  $user
             * @return string
             */
            protected function getDisplayName(User $user)
            {
                return $user->name ?: $user->email;
            }
        }
