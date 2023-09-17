<?php

namespace App\Livewire\Web\Other;

use Livewire\Component;

class Cookie extends Component
{
    public $showConsent = false;

    public function mount()
    {

        sleep(8);

        if (!isset($_COOKIE['cookie_consent_find'])) {
            $this->showConsent = true;
        } elseif ($_COOKIE['cookie_consent_find'] === 'declined') {
            $declinedTime = session('cookie_declined_time');
            if (!$declinedTime || (time() - $declinedTime) >= 86400) { // 86400 secondes = 24 heures
                $this->showConsent = true;
            } else {
                $this->showConsent = false;
            }
        }
    }

    public function acceptCookies()
    {
        setcookie('cookie_consent_find', 'accepted', time() + (86400 * 365), "/"); // Expire après 1 an
        $this->showConsent = false;
    }
    public function declineCookies()
    {
        setcookie('cookie_consent_find', 'declined', time() + (86400), "/");
        session(['cookie_declined_time' => time()]);  // Expire après 1 jour
        $this->showConsent = false;
    }

    public function render()
    {
        return view('livewire.web.other.cookie');
    }
}
