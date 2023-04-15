<?php

namespace App\Service;

use App\Entity\Program;
use App\Entity\Promotion;
use App\Repository\PromotionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ReservationService
{
    private SessionInterface $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function deleteProgram(Program $program): int
    {
        if ($this->session->has($program->getTitle())) {
            if ($this->session->get($program->getTitle()) != 0) {
                $qtn = $this->session->get($program->getTitle());
                $this->session->set($program->getTitle(), $qtn - 1);
            }
        }
        return $this->getPriceAfterDelete($program);
    }

    public function getPriceAfterDelete(Program $program): int
    {
        $prix = $this->getPriceBeforeChanges();
        if ($this->session->has($program->getTitle())) {
            $prixUnitaire = $program->getPrice();
            $prix = $prix - $prixUnitaire;
        }
        return $this->applyPromo($prix);
    }

    public function addProgram(Program $program, Request $request): int
    {
        $rep = $program->getTitle();
        if ($request->get('promo') === 'codepromo') {
            $quantity = -5;
            $this->session->set('code-promo', $quantity);
        } else {
            if ($this->session->has($rep)) {
                $quantity = $this->session->get($rep);
            } else {
                $quantity = 0;
            }
            $this->session->set($rep, $quantity + 1);
        }
        return $this->getPriceAfterAdding($program);

    }

    public function getPriceAfterAdding(Program $program): int
    {
        $prix = $this->getPriceBeforeChanges();
        if ($this->session->has($program->getTitle())) {
            $prixUnitaire = $program->getPrice();
            $prix = $prix + $prixUnitaire;
        }
        return $this->applyPromo($prix);
    }

    public function applyPromo(int $prix): int
    {
        $promo = 'promo';
        if ($this->session->has($promo)) {
            (integer)$prix = $prix - ($prix * ($this->session->get($promo) / 100));
        }
        $this->session->set("priceTotal", $prix);
        return $prix;
    }

    public function getPriceBeforeChanges(): int
    {
        if ($this->session->has("priceTotal")) {
            $prix = $this->session->get('priceTotal');
        } else {
            $prix = 0;
        }
        return $prix;
    }

    public function getQuantity(array $programmes): int
    {
        $qtn = 0;
        foreach ($programmes as $p) {
            if ($this->session->has($p->getTitle())) {
                $uniqueQtn = $this->session->get($p->getTitle());
                $qtn = $qtn + $uniqueQtn;
            }
        }
        return $qtn;
    }

    public function getPriceByUnity(array $programmes): int
    {
        $qtn = 0;
        $prixUnitaire = 0;
        foreach ($programmes as $p) {
            if ($this->session->has($p->getTitle())) {
                $uniqueQtn = $this->session->get($p->getTitle());
                $qtn = $qtn + $uniqueQtn;
                $prixUnitaire = $prixUnitaire + $p->getPrice();
            }
        }
        return $prixUnitaire;
    }

    public function addPromotion(Promotion $promotion, PromotionRepository $promotionRepository) : void
    {
        $pr = $promotionRepository->findBy(['code_promo' => $promotion]);
        if (count($pr) > 0) {
            $promoBdd = $pr[0];
            $rep = 'promo';
            if ($this->session->has($rep)) {
                $qtn = $this->session->get($rep);
            } else {
                $qtn = $promoBdd->getReduction();
            }
            $this->session->set($rep, $qtn);
        }
    }

}