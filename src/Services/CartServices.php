<?php
namespace App\Services;

use App\Entity\Account;
use App\Entity\Reservation;
use App\Repository\ProgramRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Component\HttpFoundation\Request;
use  Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Program;
use App\Form\ProgramType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartServices
{
/*
    private Reservation $reservation;

    private $tva = 0.2;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }
*/
    public function incrementeReservation() : self
    {
        $newQtn=$this->reservation->getQteNormal();
        $newQtn++;
        $this->reservation->setQteNormal($newQtn);
        return $this;

    }

    public function supprimeReserva() : self
    {
        $newQtn=$this->reservation->getQteNormal();
        if ($newQtn>0){
            $newQtn--;
            $this->reservation->setQteNormal($newQtn);
        }

        return $this;
        //recuperer donnée avec id et decrementer par rapport au nbrTodelte

    }

    public function supprimeToutReserva() : self
    {
        $this->reservation->setQteNormal(0);
        //qtn=0
        return $this;
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
        $calculPourcent=$this->recupererTotalMontant()*$this->tva;
        $calculAvecTva=$this->recupererTotalMontant()+$calculPourcent;
        return $calculAvecTva;
    }

}
?>