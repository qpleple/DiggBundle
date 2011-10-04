<?php

namespace Acme\DiggBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\DiggBundle\Entity\Url
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\DiggBundle\Entity\UrlRepository")
 */
class Url
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var int $facebookScore
     *
     * @ORM\Column(name="facebookScore", type="int")
     */
    private $facebookScore;

    /**
     * @var int $twitterScore
     *
     * @ORM\Column(name="twitterScore", type="int")
     */
    private $twitterScore;

    /**
     * @var int $googleScore
     *
     * @ORM\Column(name="googleScore", type="int")
     */
    private $googleScore;

    /**
     * @var int $diggScore
     *
     * @ORM\Column(name="diggScore", type="int")
     */
    private $diggScore;

    /**
     * @var int $totalScore
     *
     * @ORM\Column(name="totalScore", type="int")
     */
    private $totalScore;

    /**
     * @var datetime $lastCheck
     *
     * @ORM\Column(name="lastCheck", type="datetime")
     */
    private $lastCheck;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set facebookScore
     *
     * @param int $facebookScore
     */
    public function setFacebookScore(\int $facebookScore)
    {
        $this->facebookScore = $facebookScore;
    }

    /**
     * Get facebookScore
     *
     * @return int 
     */
    public function getFacebookScore()
    {
        return $this->facebookScore;
    }

    /**
     * Set twitterScore
     *
     * @param int $twitterScore
     */
    public function setTwitterScore(\int $twitterScore)
    {
        $this->twitterScore = $twitterScore;
    }

    /**
     * Get twitterScore
     *
     * @return int 
     */
    public function getTwitterScore()
    {
        return $this->twitterScore;
    }

    /**
     * Set googleScore
     *
     * @param int $googleScore
     */
    public function setGoogleScore(\int $googleScore)
    {
        $this->googleScore = $googleScore;
    }

    /**
     * Get googleScore
     *
     * @return int 
     */
    public function getGoogleScore()
    {
        return $this->googleScore;
    }

    /**
     * Set diggScore
     *
     * @param int $diggScore
     */
    public function setDiggScore(\int $diggScore)
    {
        $this->diggScore = $diggScore;
    }

    /**
     * Get diggScore
     *
     * @return int 
     */
    public function getDiggScore()
    {
        return $this->diggScore;
    }

    /**
     * Set totalScore
     *
     * @param int $totalScore
     */
    public function setTotalScore(\int $totalScore)
    {
        $this->totalScore = $totalScore;
    }

    /**
     * Get totalScore
     *
     * @return int 
     */
    public function getTotalScore()
    {
        return $this->totalScore;
    }

    /**
     * Set lastCheck
     *
     * @param datetime $lastCheck
     */
    public function setLastCheck($lastCheck)
    {
        $this->lastCheck = $lastCheck;
    }

    /**
     * Get lastCheck
     *
     * @return datetime 
     */
    public function getLastCheck()
    {
        return $this->lastCheck;
    }
}