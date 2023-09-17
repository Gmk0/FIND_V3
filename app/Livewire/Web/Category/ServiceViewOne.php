<?php

namespace App\Livewire\Web\Category;

use App\Models\Category;
use Livewire\Component;
use App\Models\Conversation;
use App\Models\favorite;

use App\Models\FeedbackService;

use App\Models\Message;
use App\Models\Service;
use App\Models\User;
use App\Tools\Cart;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

use Filament\Actions\Action;

#[Layout('layouts.web-layout')]
class ServiceViewOne extends Component

implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public Service $service;
    public $images;
    public $products;
    public $servicesOther = null;
    public $commentaires = null;
    public $modal = false;
    public $comment = null;
    public $level = 'Basic';
    public $price;

    public $messageSent = false;

    public $body = "";

    protected $queryString = ['messageSent' => ['expect' => '']];


    public function mount($category, $service_numero)
    {

        $category = Category::where('name', $category)->exists();

        $services = Service::where('service_numero', $service_numero)->exists();




        if ($category && $services) {

            $this->service = Service::where('service_numero', $service_numero)->first();
            $this->initState();
        } else {

            session()->flash('status', 'Lien inconnue');

            return $this->redirect('/', true);
        }
    }

    public function initState()
    {


        $this->images = $this->images();

        $this->commentaires = FeedbackService::whereHas('Order', function ($query) {
            $query->whereHas('service', function ($q) {
                $q->where('id', $this->service->id);
            });
        })->where('commentaires', '!=', null)->where('is_publish', 1)
        ->get();




        $this->servicesOther = $this->GetOther();
    }
    public function GetOther()
    {
        $subCategorie = $this->service->Sub_categorie;


        //dd($subCategorie);

        if (!empty($subCategorie)) {
            $sousCategorie = $subCategorie;

            $services = Service::where('Sub_categorie', 'like', '%' . $sousCategorie . '%')
                ->whereNotIn('id', [$this->service->id])
                ->limit(5)->get();
        } else {
            $services = Service::where('category_id', $this->service->category_id)
                ->whereNotIn('id', [$this->service->id])
                ->limit(5)->get();
        }
        //dd($sousCategorie);




        return $services;
    }

    public function images()
    {

        $files = $this->service->files;
        // dd($files);
        foreach ($files as $key => $file) {
            $images = $file;
            break;
        }
        return $images;
    }

    public function toogleFavorite($serviceId)
    {


        $favorite = favorite::where('user_id', auth()->id())
            ->where('service_id', $serviceId)
            ->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            favorite::create([
                'user_id' => auth()->id(),
                'service_id' => $serviceId,
            ]);

            $this->notification()->success(
                $title = "le Service a ete ajouté au favoris",

            );
        }
    }




    public function contacter()
    {


        try{


            $conversation = Conversation::where('freelance_id', $this->service->freelance->id)
                ->whereHas('user', function ($query) {
                    $query->where('id', auth()->id());
                })
                ->first();



            if (!$conversation) {
                $conversation = new Conversation();
                $conversation->freelance_id = $this->service->freelance->id;
                $conversation->last_time_message = now();
                $conversation->status = 'pending';
                $conversation->save();
            }

            $createdMessage = Message::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $this->service->freelance->user->id,
                'conversation_id' => $conversation->id,
                'body' => $this->body,
                'is_read' => "0",
                'type' => "text",
                'service_id' => $this->service->id,

            ]);

            $this->messageSent = true;

            $this->dispatch('notify', ['message' => "Message enboyer", 'icon' => 'success',]);




        }catch(\Exception $e){


            $this->dispatch('error', [
                'message' => "une erreur s'est produite" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);
        }







        //return redirect()->route('MessageUser');
    }




    public function add_cart()
    {

        $items = $this->service;
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($items, $items->id, $this->images, $this->price, $this->level);
        Session::put('cart', $cart);
        $this->dispatch('refreshComponent');

        $this->dispatch('notify', ['message' => "Service ajouter dans le panier", 'icon' => 'success',]);


       //::send()->success();
    }

    public function addBasic()
    {

        $items = $this->service;
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($items, $items->id, $this->images, $this->service->basic_price);
        Session::put('cart', $cart);
        $this->emit('refreshComponent');
        $this->notification()->success(
            $title = "le Service a ete ajouté dans le panier",

        );
        $this->dispatch('notify', ['message' => "Service ajouter dans le panier", 'icon' => 'success',]);

    }

    public function addPremium()
    {

        $items = $this->service;
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($items, $items->id, $this->images, $this->service->premium_price, 'Premium');
        Session::put('cart', $cart);
        $this->emit('refreshComponent');
        $this->notification()->success(
            $title = "le Service a ete ajouté dans le panier",

        );

        $this->dispatch('notify', ['message' => "Service ajouter dans le panier", 'icon' => 'success',]);

    }
    public function addExtra()
    {

        $items = $this->service;
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($items, $items->id, $this->images, $this->service->extra_price, 'Extra');
        Session::put('cart', $cart);
        $this->emit('refreshComponent');
        $this->notification()->success(
            $title = "le Service a ete ajouté dans le panier",

        );
        $this->dispatch('notify', ['message' => "Service ajouter dans le panier", 'icon' => 'success',]);

    }




    public function getPriceByLevel()
    {
        switch ($this->level) {
            case 'Basic':
                return $this->service->basic_price;
            case 'Premium':
                return $this->service->premium_price;
            case 'Extra':
                return $this->service->extra_price;
            default:
                return 0; // Prix par défaut si le niveau de service n'est pas reconnu
        }
    }



    public function render()
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $this->products = $cart->items;
        $this->price = $this->getPriceByLevel();

        return view('livewire.web.category.service-view-one');
    }
}
