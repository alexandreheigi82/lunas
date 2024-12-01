<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;

class Cpf implements ValidationRule
{
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        // Remover caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $value);

        // Verificar se o CPF tem 11 dígitos
        if (strlen($cpf) != 11) {
            $fail('O campo :attribute não é um CPF válido.');
            return;
        }

        // Verificar se todos os dígitos são iguais
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $fail('O campo :attribute não é um CPF válido.');
            return;
        }

        // Calcular os dígitos verificadores para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $fail('O campo :attribute não é um CPF válido.');
                return;
            }
        }
    }
}
