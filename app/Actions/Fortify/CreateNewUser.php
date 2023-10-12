<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:13'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Dapatkan tanggal dalam format Ymd (misalnya: 20231012).
        $date = now()->format('Ymd');

        // Enkripsikan alamat email (gunakan hash atau metode enkripsi yang sesuai).
        $encryptedEmail = sha1($input['email']); // Contoh penggunaan SHA-1 untuk enkripsi email. Anda bisa menggunakan metode enkripsi yang lebih aman.

        // Gabungkan tanggal dan alamat email yang dienkripsi.
        $idCandidate = $date . $encryptedEmail;

        // Ubah hasilnya menjadi angka dengan panjang antara 1 hingga 10 digit.
        $id = abs(crc32($idCandidate)) % 10000000000;
        return User::create([
            'id' => $id,
            'name' => $input['name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'roles' => 'USER'
        ]);
    }
}
