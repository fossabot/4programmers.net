<?php
namespace Coyote\Domain\User;

use Coyote\Domain\Html;

class UserSettings
{
    public function marketingAgreement(): Html
    {
        $gdpr = '<a href="mailto:gdpr@4programmers.net">gdpr@4programmers.net</a>';
        $_4programmers = '<a href="https://4programmers.net/">4programmers.net</a>';

        return new Html("Wyrażam zgodę na otrzymywanie, na podany przeze mnie adres e-mail, informacji handlowych kierowanych do mnie 
            przez 4programmers.net (tj. Makana sp. z o.o., z siedzibą przy ul. Krupniczej 13, 50-075 Wrocław). Informacje 
            handlowe dotyczyć będą produktów, usług i działalności realizowanej przez 4programmers.net i jej kontrahentów. 
            Rozumiem, że zgodę mogę wycofać w dowolnym momencie, jednak nie będzie to miało wpływu na przetwarzanie, którego 
            dokonano przed jej wycofaniem. Przedmiotowa zgoda może zostać wycofana poprzez odznaczenie jej w ustawieniach mojego 
            konta albo poprzez wysłanie stosownej wiadomości na adres e-mail: $gdpr lub adres siedziby $_4programmers.");
    }

    public function newsletterAgreement(): Html
    {
        return new Html('Zgadzam się na otrzymywanie newslettera.');
    }

    public function termsAndPrivacyPolicyAgreement(): Html
    {
        $terms = '<a href="/Regulamin">regulamin</a>';
        $privacyPolicy = '<a href="/Polityka_prywatności">politykę prywatności</a>';

        return new Html("Akceptuję $terms oraz $privacyPolicy.<b>*</b>");
    }
}
