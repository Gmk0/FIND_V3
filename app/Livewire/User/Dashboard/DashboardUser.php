<?php

namespace App\Livewire\User\Dashboard;

use Livewire\Component;


use App\Models\Order;
use App\Models\Mission;
use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;

#[Layout('layouts.user-layout')]

#[Title('Dashboard')]

class DashboardUser extends Component
{


    use WithPagination;
    public $service;
    public $orders;
    public $transaction;
    public $user_id;
    public $transactions;
    public $pending;
    public $successfull;
    public $failed;
    public $period = 'last7days';
    public $endDate;
    public $startDate;
    protected $listeners = ['startDateUpdated'];
    public function render()
    {
        return view('livewire.user.dashboard.dashboard-user', [
            'amount' => $this->total(),
            'order' => Order::where('user_id', $this->user_id)->paginate(10),
            'orderCount' => $this->OrderWeek(),
            //'conversations' => $this->conversations(),
            'projet' => Mission::where('user_id', $this->user_id)->where('status', 'pending')->count(),
            'countTransaction' => $this->getTransactioncOUNT(),
            "percentTransaction" => $this->pourcentageChangementMoisPrecedent(),
            'orderEvolution' => $this->calculateTransactionsEvolution(),
        ]);
    }


    public function mount()
    {
        $this->user_id = auth()->user()->id;





        // $donne =

    }


    public function formatDate($date)
    {
        $carbonDate = Carbon::createFromFormat('m/d/Y', $date);
        return $carbonDate->format('Y-m-d H:i:s');
    }
    public function startDateUpdated($startDate, $endDate)
    {
        $this->startDate = $startDate;

        $this->endDate = $endDate;
    }

    public function cancel()
    {
        $this->startDate = null;

        $this->endDate = null;
    }

    function getTransactioncOUNT()
    {


        return Transaction::where('user_id', auth()->user()->id)->count();
    }

    function getTransaction()
    {
        $user = auth()->id();
        $transactions = Transaction::where('user_id', auth()->id());


        $statusFilters = [];

        if ($this->pending) {
            $statusFilters[] = 'en attente';
        }

        if ($this->failed) {
            $statusFilters[] = 'reussie';
        }

        if ($this->successfull) {
            $statusFilters[] = 'echouer';
        }

        if (!empty($statusFilters)) {
            $transactions->whereIn('status', $statusFilters);
        }

        if ($this->period === 'last7days') {
            $transactions->where('created_at', '>=', now()->subDays(7));
        } elseif ($this->period === 'last30days') {
            $transactions->where('created_at', '>=', now()->subMonths(1));
        } elseif ($this->period === 'last3months') {
            $transactions->where('created_at', '>=', now()->subMonths(3));
        } elseif ($this->period === 'last90days') {
            $transactions->where('created_at', '>=', now()->subMonths(9));
        } elseif ($this->period === 'today') {
            $transactions->where('created_at', '>=', now());
        }



        if ($this->startDate && $this->endDate) {



            $transactions->whereBetween('created_at', [$this->formatDate($this->startDate), $this->formatDate($this->endDate)]);
        }





        $transactions = $transactions->orderBy('created_at', 'desc')->get();



        return $transactions;
    }
    public function total()
    {
        $dateDebut = Carbon::now()->startOfMonth();
        $dateFin = Carbon::now()->endOfMonth();

        $user_id = $this->user_id;
        // Récupérer toutes les transactions qui ont eu lieu dans le mois en cours
        $transactions = Transaction::where('user_id', $user_id)
            ->where('status', 'completed')->sum('amount');

        // Calculer le total de tous les montants des transactions trouvées
        /* $transactions = $transactions->map(function ($transaction) {
            $transaction->total_amount = $transaction->total_amount;
            return $transaction;
        }); */

        // Calculer le total de tous les montants des transactions trouvées
        $total = '$' . number_format($transactions, 2, ',', ' ');
        return $total;
    }

    public function OrderWeek()
    {

        $date = Carbon::now()->subDays(7);

        // Récupérer toutes les commandes créées au cours des 7 derniers jours


        $user_id = $this->user_id;

        $orders = Order::where('user_id', $user_id)->whereBetween('created_at', [$date, Carbon::now()])->get();


        // Compter le nombre de commandes trouvées
        return  $nombreDeTransactions = $orders->count();
    }





    function pourcentageChangementMoisPrecedent()
    {
        $user_id = $this->user_id;

        $debutMoisEnCours = Carbon::now()->startOfMonth();
        $finMoisEnCours = Carbon::now()->endOfMonth();
        $debutMoisPrecedent = Carbon::now()->subMonth()->startOfMonth();
        $finMoisPrecedent = Carbon::now()->subMonth()->endOfMonth();


        $totalArgentMoisEnCours = Order::where('user_id', $user_id)
            ->whereBetween('created_at', [$debutMoisEnCours, $finMoisEnCours])
            ->sum('total_amount');

        $totalArgentMoisPrecedent = Order::where('user_id', $user_id)
            ->whereBetween('created_at', [$debutMoisPrecedent, $finMoisPrecedent])
            ->sum('total_amount');

        $diffArgent = $totalArgentMoisEnCours - $totalArgentMoisPrecedent;

        // Calculer le pourcentage de changement
        if ($totalArgentMoisPrecedent != 0) {
            $pourcentageChangement = ($diffArgent / $totalArgentMoisPrecedent) * 100;
        } else {
            $pourcentageChangement = 0;
        }

        return $pourcentageChangement;
    }

    function calculateTransactionsEvolution()
    {
        $user_id = $this->user_id;

        $date = Carbon::now()->subDays(7);

        // Récupérer toutes les commandes créées au cours des 7 derniers jours
        $this->orders = Order::where('user_id', $user_id)->whereBetween('created_at', [$date, Carbon::now()])->get();

        // Compter le nombre de commandes trouvées
        $nombreDeTransactions = $this->orders->count();

        // Récupérer le nombre de commandes créées lors de la semaine précédente
        $nombreDeTransactionsSemainePrecedente = Order::where('user_id', $user_id)
            ->whereBetween('created_at', [$date->subDays(7), $date])->count();

        // Calculer l'évolution en pourcentage
        if ($nombreDeTransactionsSemainePrecedente != 0) {
            $pourcentageEvolution = (($nombreDeTransactions - $nombreDeTransactionsSemainePrecedente) / $nombreDeTransactionsSemainePrecedente) * 100;
        } else {
            $pourcentageEvolution = 0;
        };

        return $pourcentageEvolution;
    }

}
