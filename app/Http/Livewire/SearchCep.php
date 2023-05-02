<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchCep extends Component
{

    public function updatedCep(string $value)
    {
        $response = Http::get("https://viacep.com.br/ws/{$value}/json/")->json();
        dd($response);
    }

    public function render()
    {
        return view('livewire.search-cep');
    }
}
