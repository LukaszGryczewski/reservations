<?php

namespace App\Http\Controllers;

use App\Models\Show;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Laravel\Cashier\Facades\Stripe;
use Laravel\Cashier\SubscriptionBuilder;

class PaymentController extends Controller
{
    /*public function processPayment(Request $request)
    {
        // Logique pour traiter le paiement avec Stripe

        // Vérifiez si l'utilisateur est authentifié
        if ($request->user()) {
            $user = $request->user();
            $paymentMethod = $user->defaultPaymentMethod();

            // Récupérez l'ID de la pièce de théâtre à partir de la requête
            $showId = $request->input('show_id');

            // Récupérez le prix de la pièce de théâtre à partir de la base de données
            $show = Show::findOrFail($showId);
            $price = $show->price;

            // Créez un paiement avec le prix spécifié
            $payment = PaymentIntent::create([
                'amount' => $price,
                'currency' => 'eur',
                'payment_method' => $paymentMethod->id,
                'customer' => $user->stripe_id,
                'off_session' => true,
                'confirm' => true,
            ]);

            // Vérifiez si le paiement a réussi
            if ($payment->status === 'succeeded') {
                // Redirigez vers la page de succès
                return redirect()->route('payment.success')->with('success', 'Paiement réussi');
            } else {
                // Gérez le cas où le paiement a échoué
                return redirect()->route('payment.failure')->with('error', 'Le paiement a échoué');
            }
        } else {
            // Gérez le cas où l'utilisateur n'est pas authentifié
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour effectuer le paiement');
        }
    }*/
    public function processPayment(Request $request)
    {
        // Logique pour traiter le paiement avec Stripe

        // Vérifiez si l'utilisateur est authentifié
        if ($request->user()) {
            $user = $request->user();
            $paymentMethod = $user->defaultPaymentMethod();

            if ($paymentMethod) {
                // Récupérez l'ID de la pièce de théâtre à partir de la requête
                $showId = $request->input('show_id');

                // Récupérez le prix de la pièce de théâtre à partir de la base de données
                $show = Show::findOrFail($showId);
                $price = $show->price;

                // Créez un paiement avec le prix spécifié
                $payment = $user->charge($price, $paymentMethod->id);

                // Vérifiez si le paiement a réussi
                if ($payment->status === 'succeeded') {
                    // Redirigez vers la page de succès
                    return redirect()->route('payment.success')->with('success', 'Paiement réussi');
                } else {
                    // Gérez le cas où le paiement a échoué
                    return redirect()->route('payment.failure')->with('error', 'Le paiement a échoué');
                }
            } else {
                // Gérez le cas où la méthode de paiement par défaut n'existe pas
                return redirect()->route('payment.failure')->with('error', 'Aucune méthode de paiement par défaut trouvée');
            }
        } else {
            // Gérez le cas où l'utilisateur n'est pas authentifié
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour effectuer le paiement');
        }
    }

    public function paymentSuccess()
    {
        // Logique pour la page de confirmation de paiement réussi

        return view('payment.success');
    }

    public function paymentFailure()
    {
        // Logique pour la page de traitement de l'échec de paiement

        return view('payment.failure');
    }
}
