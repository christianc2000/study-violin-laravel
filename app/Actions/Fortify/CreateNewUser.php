<?php

namespace App\Actions\Fortify;

use App\Models\Plan;
use App\Models\Profesor;
use App\Models\Suscripcion;
use App\Models\Tutor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'ci' => ['required', 'string', 'unique:users,ci'],
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'birth_date' => ['required', 'date'],
            'address' => ['required', 'string'],
            'registro' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'plan_id' => ['required', 'exists:plans,id'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'ci' => $input['ci'],
            'name' => $input['name'],
            'lastname' => $input['lastname'],
            'gender' => $input['gender'],
            'birth_date' => $input['birth_date'],
            'address' => $input['address'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        if ($input['registro'] == 1) {
            Profesor::create([
                'id' => $user->id
            ]);
        } else {
            Tutor::create([
                'id' => $user->id
            ]);
        }

        $plan = Plan::find($input['plan_id']);
        $fechaRegistro = Carbon::now();
        $fechaFinalizacion = $fechaRegistro->addMonths($plan->mes);
        Suscripcion::create([
            'estado' => true,
            'cantidad_mes' => $plan->mes,
            'costo_total' => $plan->costo,
            'fecha_registro' => Carbon::now(),
            'fecha_finalizacion' => $fechaFinalizacion,
            'plan_id' => $plan->id,
            'user_id' => $user->id
        ]);
        return $user;
    }
}
