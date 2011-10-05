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
     * @var string $address
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var integer $facebookScore
     *
     * @ORM\Column(name="facebookScore", type="integer")
     */
    private $facebookScore;

    /**
     * @var integer $twitterScore
     *
     * @ORM\Column(name="twitterScore", type="integer")
     */
    private $twitterScore;

    /**
     * @var integer $googleScore
     *
     * @ORM\Column(name="googleScore", type="integer")
     */
    private $googleScore;

    /**
     * @var integer $diggScore
     *
     * @ORM\Column(name="diggScore", type="integer")
     */
    private $diggScore;

    /**
     * @var integer $totalScore
     *
     * @ORM\Column(name="totalScore", type="integer")
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
     * Set address
     *
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set facebookScore
     *
     * @param integer $facebookScore
     */
    public function setFacebookScore($facebookScore)
    {
        $this->facebookScore = $facebookScore;
    }

    /**
     * Get facebookScore
     *
     * @return integer 
     */
    public function getFacebookScore()
    {
        return $this->facebookScore;
    }

    /**
     * Set twitterScore
     *
     * @param integer $twitterScore
     */
    public function setTwitterScore($twitterScore)
    {
        $this->twitterScore = $twitterScore;
    }

    /**
     * Get twitterScore
     *
     * @return integer 
     */
    public function getTwitterScore()
    {
        return $this->twitterScore;
    }

    /**
     * Set googleScore
     *
     * @param integer $googleScore
     */
    public function setGoogleScore($googleScore)
    {
        $this->googleScore = $googleScore;
    }

    /**
     * Get googleScore
     *
     * @return integer 
     */
    public function getGoogleScore()
    {
        return $this->googleScore;
    }

    /**
     * Set diggScore
     *
     * @param integer $diggScore
     */
    public function setDiggScore($diggScore)
    {
        $this->diggScore = $diggScore;
    }

    /**
     * Get diggScore
     *
     * @return integer 
     */
    public function getDiggScore()
    {
        return $this->diggScore;
    }

    /**
     * Set totalScore
     *
     * @param integer $totalScore
     */
    public function setTotalScore($totalScore)
    {
        $this->totalScore = $totalScore;
    }

    /**
     * Get totalScore
     *
     * @return integer 
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



	/**
     *  update totalScore
     *
     * 
     */
    public function updateTotalScore()
    {
		$sum = $this->getFacebookScore() + $this->getTwitterScore() + $this->getDiggScore() + $this->getGoogleScore();
        $this->setTotalScore($sum)
    }


    /**
     * facebookScoreCheck() 
     *
     * 
     */	
	public function facebookScoreCheck() 
	{
		
		// example : http://graph.facebook.com/?ids=http://google.fr/
		// we can retrieve multiple results, see http://graph.facebook.com/?ids=http://google.fr/,http://google.com
		// could be cool to update lots of links at the same time
	
		$facebookUrlAsk = "http://graph.facebook.com/?ids=" . $this.getAddress();

	    $jsonData = file_get_contents($facebookUrlAsk,0,null,null);
	    $jsonAsArray = json_decode($jsonData,true);
	    $lastCounts = (integer) $jsonAsArray[$address]['shares']; 
				// surprisingly, here it's called 'shares' and not 'likes' 
				// although it's the number of likes
		if(not($lastCounts == $this->getFacebookScore())) {
			$this->setFacebookScore($lastCounts);
			$this->updateTotalScore();
		}
	}
	
	
    /**
     * twitterScoreCheck() 
     *
     * 
     */	
	public function twitterScoreCheck() 
	{
		// example : http://otter.topsy.com/stats.js?url=http://qpleple.com
		$twitterUrlAsk = "http://otter.topsy.com/stats.js?url=" . $this.getAddress();
		
		$jsonData = file_get_contents($twitterUrlAsk,0,null,null);
		$jsonAsArray = json_decode($jsonData,true);
		$lastCounts = (integer) $jsonAsArray['response']['all'];
		if(not($lastCounts == $this->getTwitterScore())) {
			$this->setTwitterScore($lastCounts);
			$this->updateTotalScore();
		}
	}





}













}