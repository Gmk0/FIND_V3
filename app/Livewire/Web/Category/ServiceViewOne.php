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

#[Layout('layouts.web-layout')]
class ServiceViewOne extends Component
{
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




        $conversation = Conversation::where('freelance_id', $this->service->freelance->id)
            ->whereHas('user', function ($query) {
                $query->where('id', auth()->id());
            })
            ->first();






        //return redirect()->route('user', ['id' => $this->service->freelance->user->id]);











        // Si une conversation est trouvée, afficher la vue de la conversation

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






        //return redirect()->route('MessageUser');
    }



    public function contacters()
    {
        $freelanceId = $this->service->freelance->id;

        $conversation = Conversation::where('freelance_id', $freelanceId)
            ->whereHas('user', function ($query) {
                $query->where('id', auth()->id());
            })
            ->first();

        if ($conversation) {
            $createdMessage = Message::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $freelanceId,
                'conversation_id' => $conversation->id,
                'service_id' => $this->service->id,
                'body' => "salut je suis interrser par ce service",
                'is_read' => '0',
                'type' => "text",

            ]);
            return redirect()->route('MessageUser');
        }


        $conversation = new Conversation();
        $conversation->freelance_id = $freelanceId;
        $conversation->last_time_message = now();
        $conversation->status = 'pending';
        $conversation->save();


        $createdMessage = Message::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $freelanceId,
            'conversation_id' => $conversation->id,
            'service_id' => $this->service->id,
            'body' => "salut je suis interrser par ce service",
            'is_read' => '0',
            'type' => "text",

        ]);
        return redirect()->route('MessageUser');
    }
    public function add_cart()
    {

        $items = $this->service;
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($items, $items->id, $this->images, $this->price, $this->level);
        Session::put('cart', $cart);
        $this->dispatch('refreshComponent');

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
