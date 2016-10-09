<?php

namespace AppBundle\Form;

use Symfony\Component\Validator\Constraints as Assert;

class TicketType
{
    /**
     * @Assert\NotBlank(message = "Podaj opis")
     * @Assert\Length(min = 10, max = 1000,
     *     minMessage = "Opis musi składać się z przynajmniej {{ limit }} znaków",
     *     maxMessage = "Opis nie może przekraczać {{ limit }} znaków")
     */
    public $description;

    /**
     * @Assert\NotBlank(message = "Wybierz kategorię")
     */
    public $category;

    /**
     * @Assert\NotBlank(message = "Wybierz miejsce")
     */
    public $latitude;

    /**
     * @Assert\NotBlank(message = "Wybierz miejsce")
     */
    public $longitude;

    /**
     * @Assert\NotBlank(message = "Podaj imię i nazwisko")
     * @Assert\Length(min = 5, max = 100,
     *     minMessage = "Imię i nazwisko musi składać się z przynajmniej {{ limit }} znaków",
     *     maxMessage = "Imię i nazwisko nie może przekraczać {{ limit }} znaków")
     */
    public $notifier_name;

    /**
     * @Assert\NotBlank(message = "Podaj adres e-mail")
     * @Assert\Email(message = "Podaj prawidłowy adres e-mail.")
     * @Assert\Length(max = 100, maxMessage = "Adres e-mail nie może przekraczać {{ limit }} znaków")
     */
    public $notifier_email;

    /**
     * @Assert\Length(max = 20, maxMessage = "Numer telefonu nie może przekraczać {{ limit }} znaków")
     */
    public $notifier_phone;

    /**
     * TicketType constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->description = isset($data['description']) ? $data['description'] : '';
        $this->category = isset($data['category']) ? $data['category'] : '';
        $this->latitude = isset($data['latitude']) ? $data['latitude'] : '';
        $this->longitude = isset($data['longitude']) ? $data['longitude'] : '';
        $this->notifier_name = isset($data['notifier_name']) ? $data['notifier_name'] : '';
        $this->notifier_email = isset($data['notifier_email']) ? $data['notifier_email'] : '';
        $this->notifier_phone = isset($data['notifier_phone']) ? $data['notifier_phone'] : '';

    }
}