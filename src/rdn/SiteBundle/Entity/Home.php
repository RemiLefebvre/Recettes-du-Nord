<?php

namespace rdn\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Home
 *
 * @ORM\Table(name="home")
 * @ORM\Entity(repositoryClass="rdn\SiteBundle\Repository\HomeRepository")
 */
class Home
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="personne", type="smallint")
     */
    private $personne;

    /**
     * @var int
     *
     * @ORM\Column(name="note", type="smallint")
     */
    private $note;

    /**
     * @var int
     *
     * @ORM\Column(name="time", type="smallint")
     */
    private $time;

    /**
     * @var array
     *
     * @ORM\Column(name="ingr", type="string", length=255)
     */
    private $ingr;

    /**
     * @var string
     *
     * @ORM\Column(name="step1", type="text")
     */
    private $step1;

    /**
     * @var string
     *
     * @ORM\Column(name="step1img", type="string", length=255)
     */
    private $step1img;

    /**
     * @var string
     *
     * @ORM\Column(name="step2", type="text")
     */
    private $step2;

    /**
     * @var string
     *
     * @ORM\Column(name="step2img", type="string", length=255)
     */
    private $step2img;

    /**
     * @var string
     *
     * @ORM\Column(name="step3", type="text")
     */
    private $step3;

    /**
     * @var string
     *
     * @ORM\Column(name="step3img", type="string", length=255)
     */
    private $step3img;

    /**
     * @var string
     *
     * @ORM\Column(name="historyTitle", type="string", length=255)
     */
    private $historyTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="history", type="text")
     */
    private $history;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255)
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="imgIngr", type="string", length=255)
     */
    private $imgIngr;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Home
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set personne
     *
     * @param integer $personne
     *
     * @return Home
     */
    public function setPersonne($personne)
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get personne
     *
     * @return int
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * Set note
     *
     * @param integer $note
     *
     * @return Home
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set time
     *
     * @param integer $time
     *
     * @return Home
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set ingr
     *
     * @param array $ingr
     *
     * @return Home
     */
    public function setIngr($ingr)
    {
        $this->ingr = $ingr;

        return $this;
    }

    /**
     * Get ingr
     *
     * @return array
     */
    public function getIngr()
    {
        return $this->ingr;
    }

    /**
     * Set step1
     *
     * @param string $step1
     *
     * @return Home
     */
    public function setStep1($step1)
    {
        $this->step1 = $step1;

        return $this;
    }

    /**
     * Get step1
     *
     * @return string
     */
    public function getStep1()
    {
        return $this->step1;
    }

    /**
     * Set step1img
     *
     * @param string $step1img
     *
     * @return Home
     */
    public function setStep1img($step1img)
    {
        $this->step1img = $step1img;

        return $this;
    }

    /**
     * Get step1img
     *
     * @return string
     */
    public function getStep1img()
    {
        return $this->step1img;
    }

    /**
     * Set step2
     *
     * @param string $step2
     *
     * @return Home
     */
    public function setStep2($step2)
    {
        $this->step2 = $step2;

        return $this;
    }

    /**
     * Get step2
     *
     * @return string
     */
    public function getStep2()
    {
        return $this->step2;
    }

    /**
     * Set step2img
     *
     * @param string $step2img
     *
     * @return Home
     */
    public function setStep2img($step2img)
    {
        $this->step2img = $step2img;

        return $this;
    }

    /**
     * Get step2img
     *
     * @return string
     */
    public function getStep2img()
    {
        return $this->step2img;
    }

    /**
     * Set step3
     *
     * @param string $step3
     *
     * @return Home
     */
    public function setStep3($step3)
    {
        $this->step3 = $step3;

        return $this;
    }

    /**
     * Get step3
     *
     * @return string
     */
    public function getStep3()
    {
        return $this->step3;
    }

    /**
     * Set step3img
     *
     * @param string $step3img
     *
     * @return Home
     */
    public function setStep3img($step3img)
    {
        $this->step3img = $step3img;

        return $this;
    }

    /**
     * Get step3img
     *
     * @return string
     */
    public function getStep3img()
    {
        return $this->step3img;
    }

    /**
     * Set historyTitle
     *
     * @param string $historyTitle
     *
     * @return Home
     */
    public function setHistoryTitle($historyTitle)
    {
        $this->historyTitle = $historyTitle;

        return $this;
    }

    /**
     * Get historyTitle
     *
     * @return string
     */
    public function getHistoryTitle()
    {
        return $this->historyTitle;
    }

    /**
     * Set history
     *
     * @param string $history
     *
     * @return Home
     */
    public function setHistory($history)
    {
        $this->history = $history;

        return $this;
    }

    /**
     * Get history
     *
     * @return string
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * Set img
     *
     * @param string $img
     *
     * @return Home
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set imgIngr
     *
     * @param string $imgIngr
     *
     * @return Home
     */
    public function setImgIngr($imgIngr)
    {
        $this->imgIngr = $imgIngr;

        return $this;
    }

    /**
     * Get imgIngr
     *
     * @return string
     */
    public function getImgIngr()
    {
        return $this->imgIngr;
    }
}
