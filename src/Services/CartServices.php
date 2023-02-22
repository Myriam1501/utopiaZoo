<?php
namespace App\Services;

use App\Entity\Account;
use App\Entity\Reservation;
use App\Entity\Ticket;
use App\Repository\ProgramRepository;
use App\Repository\TicketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\Self_;
use phpDocumentor\Reflection\Types\Void_;
use PhpParser\Node\Expr\Cast\Double;
use Symfony\Component\HttpFoundation\Request;
use  Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Program;
use App\Form\ProgramType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartServices
{

    private TicketRepository $ticketRepo;
    private ObjectManager $manager;
    private Ticket $ticket;

    private $tva = 0.2;
    public function __construct(TicketRepository $ticket,EntityManagerInterface $manager)
    {
        $this->manager=$manager;
        $this->ticketRepo = $ticket;

    }

    public function addTicket() : self
    {
        $qtn=$this->ticket->getQteNormal();
        $qtn=$qtn+1;
        $this->ticket->setQteNormal($qtn);
        $this->manager->persist($this->ticket);

        $this->manager->flush();
        return $this;
    }

    public function dellTicket() : self
    {
        $qtn=$this->ticket->getQteNormal();
        if($qtn>=0 ){
            $qtn=$qtn-1;
            $this->ticket->setQteNormal($qtn);
            $this->manager->persist($this->ticket);

            $this->manager->flush();
        }


        return $this;
    }

    public function getTotalPrice() : float
    {
        $qtn=$this->ticket->getQteNormal();
        $prix=$this->ticket->getProgram();
        $total=$prix*$qtn;
        return $total;
    }





}
?>