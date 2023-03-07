<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use App\Entity\Program;
use App\Entity\Reservation;
use App\Entity\User;
use App\Repository\AnimalRepository;
use App\Repository\ProgramRepository;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    protected $userRepository;
    protected $reservationRepository;
    protected $animalRepository;
    protected $programRepository;

    public function __construct(
        UserRepository $userRepository,
        ReservationRepository $reservationRepository,
        AnimalRepository $animalRepository,
        ProgramRepository $programRepository
    ){
        $this -> userRepository = $userRepository;
        $this -> reservationRepository = $reservationRepository;
        $this -> animalRepository = $animalRepository;
        $this -> programRepository = $programRepository;
    }
    #[Route('/essaie/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig',[
            'countAllUser' => $this -> userRepository->countAllUser(),
            'countAllReservation' => $this -> reservationRepository->countAllReservation(),
            'countAllAnimal' => $this->animalRepository->countAllAnimal(),
            'countAllProgram' => $this->programRepository->countAllProgram()
    ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('UtopiaZoo - Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa-solid fa-chart-line');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-users', User::class);
        yield MenuItem::linkToCrud('Programmes', 'fa-sharp fa-solid fa-star', Program::class);
        yield MenuItem::linkToCrud('Réservations', 'fa-solid fa-pen-to-square', Reservation::class);
        yield MenuItem::linkToCrud('Animaux', 'fa-solid fa-paw', Animal::class);
    }
}
