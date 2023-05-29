<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Laravel\Cashier\Facades\Stripe;
//use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // ...

    public function subscribe(Request $request)
    {
        $user = $request->user();
        $paymentMethod = $request->payment_method;

        // Créer un nouvel abonnement
        $user->newSubscription('plan', 'stripe_plan')->create($paymentMethod);

        // Rediriger l'utilisateur vers une page de confirmation ou de succès
        return redirect()->route('confirmation')->with('success', 'Abonnement créé avec succès');
    }

    public function updatePaymentMethod(Request $request)
    {
        $user = $request->user();
        $paymentMethod = $request->payment_method;

        // Mettre à jour la méthode de paiement par défaut
        $user->updateDefaultPaymentMethod($paymentMethod);

        // Rediriger l'utilisateur vers une page de confirmation ou de succès
        return redirect()->route('confirmation')->with('success', 'Méthode de paiement mise à jour avec succès');
    }
}
