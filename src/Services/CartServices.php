<?php
namespace App\Services;

use App\Entity\Account;
use App\Entity\Reservation;
use App\Repository\ProgramRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Integer;
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
        $newQtn=$this->reservation->getQteNormal();
        $newQtn++;
        $this->reservation->setQteNormal($newQtn);

    }

    public function supprimeReserva()
    {
        $newQtn=$this->reservation->getQteNormal();
        if ($newQtn>0){
            $newQtn--;
            $this->reservation->setQteNormal($newQtn);
        }

        //recuperer donnée avec id et decrementer par rapport au nbrTodelte

    }

    public function supprimeToutReserva()
    {
        $this->reservation->setQteNormal(0);
        //qtn=0

    }

    public function getTotalPriceByProgram() : Integer
    {
        $prixProgram=$this->reservation->getPrograms()->first()->getPrice();
        $qtn=$this->reservation->getQteNormal();
        $coutTotal=$qtn*$prixProgram;
        return $coutTotal;
    }

    public function recupererTotalMontant() : Integer
    {
        return $this->getTotalPriceByProgram();
        //recup qtn et prix et calcul
    }

    public function recupTotalApresTVA() : Integer
    {
        //appel montant totzl et *appliquer tva
        $calculPourcent=$this->recupererTotalMontant()*(20/100);
        $calculAvecTva=$this->recupererTotalMontant()+$calculPourcent;
        return $calculAvecTva;
    }




    public function addAccount($idaccount)
    {

        //insertion de donnée avec account id=idaccount ET QTN=1

    }

    public function validerReservation()
    {
        //generer id pour le payment et passer au paiement
        //CREE OBJET PAIMENT
    }
}
?>