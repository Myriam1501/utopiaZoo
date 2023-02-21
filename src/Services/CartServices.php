<?php
namespace App\Services;

use App\Entity\Account;
use App\Entity\Reservation;
use App\Repository\ProgramRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use  Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Program;
use App\Form\ProgramType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartServices
{

    private Reservation $reservation;

    private $tva = 0.2;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function incrementeReservation()
    {
        // recup la donnéee avec le $id
        // INCREMENTER QTN

    }

    public function supprimeReserva()
    {
        //recuperer donnée avec id et decrementer par rapport au nbrTodelte

    }

    public function supprimeToutReserva()
    {
        //qtn=0

    }

    public function validerReservation()
    {
        //generer id pour le payment et passer au paiement
    }

    public function recupTotalApresTVA()
    {
        //appel montant totzl et *appliquer tva
    }


    public function recupererTotalMontant()
    {
        //recup qtn et prix et calcul
    }


    public function creeReservation($idaccount)
    {
        //insertion de donnée avec account id=idaccount ET QTN=1

    }

}
?>