<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
        'has_to_change_password',
        'image_path',
        'cellphone',
        'address',
        'city',
        'province',
        'cap',
        'role',
        'job_position',
        'status',
        'remember_me',
    ];

    protected $hidden = [
        'password',
        'remember_me',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function client(): HasOne
    {
        return $this->hasOne(Client::class, 'user_id_creation');
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->name}";
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn(string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    public static function generateRandomString($length = 8)
    {
        return Str::random($length);
    }

    public static function changeForgottenPassword($validatedData)
    {
        DB::beginTransaction();
        $user = User::where('email', $validatedData['forgotPasswordEmail'])->first();

        if (is_null($user)) {
            session()->flash('message', "L'indirizzo email inserito non è stato trovato...");
            session()->flash('type', 'red');

            return view('login');
        }

        $newPassword = User::generateRandomString();

        try {
            $user->has_to_change_password = true;
            $user->email_verified_at = null;
            $user->password = Hash::make($newPassword);

            if ($user->save()) {
                Mail::to($user->email)->send(new \App\Mail\PasswordResetMail($newPassword));

                DB::commit();

                session()->flash('message', "Una nuova password è stata inviata al tuo indirizzo email. Controlla la tua casella di posta (anche la sezione spam)");
                session()->flash('type', 'blue');

                return view('login');
            }
        } catch (Exception $e) {
            Log::error("Errore password dimenticata utente:  {$user->email}. Errore: " . $e->getMessage());
            DB::rollBack();
            return redirect()->route('home')->with('error', 'Errore nel cambiare la password, per favore prova di nuovo...');
        }
    }
}
