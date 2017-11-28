<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\BalanceSheetRepository;

class BalanceSheetService
{
    private $balanceSheetRepository;

    public function __construct(BalanceSheetRepository $balanceSheetRepository)
    {
        $this->balanceSheetRepository = $balanceSheetRepository;
    }

    public function store(Request $request)
    {
        $bs = $this->balanceSheetRepository->store($request);
        return $bs;
    }

    public function update(Request $request, $id = null)
    {
        if($id) {
            $bs = $this->balanceSheetRepository->update($request, $id);
            return $bs;
        }

        abort(404);
    }
}