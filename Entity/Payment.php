<?php
// src/SIAPEP/GocardlessBundle/Entity/Payment.php
 
namespace SIAPEP\GocardlessBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
 
/**
 * @ORM\Entity(repositoryClass="PaymentRepository")
 * @ORM\Table(name="siapep_gocardless_bundle_payment")
 */

class Payment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\generatedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_id", type="string", length=255, nullable=true)
     */
    
    private $gc_id;

    /**
     * @ORM\ManyToOne(targetEntity="SIAPEP\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="local_user", referencedColumnName="id", nullable=false)
     */
    
    private $local_user;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_amount", type="string", length=255)
     */
    
    private $gc_amount;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_currency", type="string", length=255, nullable=true)
     */
    
    private $gc_currency;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_description", type="string", length=255, nullable=true)
     */
    
    private $gc_description;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_charge_date", type="string", length=255)
     */
    
    private $gc_charge_date;

    /**
     * @ORM\ManyToOne(targetEntity="SIAPEP\GocardlessBundle\Entity\Subscription", inversedBy="payments")
     * @ORM\JoinColumn(nullable=false)
     */
    
    private $subscription;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_status", type="string", length=255)
     */
    
    private $gc_status;

    /**
     * @var datetime
     *
     * @ORM\Column(type="datetime")
     */
    
    private $created;

    /**
     * @var datetime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity="SIAPEP\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="posted_by", referencedColumnName="id", nullable=false)
     */

    private $posted_by;
 
    public function __construct()
    {
        // your own logic
        $this->status = 'not_submitted';/**/

    }

    /**
     * Set id
     *
     * @param string $id
     * @return Payment
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set gc_id
     *
     * @param string $gc_id
     * @return Customer
     */
    public function setGcId($gc_id)
    {
        $this->gc_id = $gc_id;

        return $this;
    }

    /**
     * Get gc_id
     *
     * @return string 
     */
    public function getGcId()
    {
        return $this->gc_id;
    }

    /**
     * Set local_user
     *
     * @param string $local_user
     * @return Payment
     */
    public function setLocalUser($local_user)
    {
        $this->local_user = $local_user;

        return $this;
    }

    /**
     * Get local_user
     *
     * @return string 
     */
    public function getLocalUser()
    {
        return $this->local_user;
    }

    /**
     * Set gc_amount
     *
     * @param string $gc_amount
     * @return Payment
     */
    public function setGcAmount($gc_amount)
    {
        $this->gc_amount = $gc_amount;

        return $this;
    }

    /**
     * Get gc_amount
     *
     * @return string 
     */
    public function getGcAmount()
    {
        return $this->gc_amount;
    }

    /**
     * Set gc_currency
     *
     * @param string $gc_currency
     * @return Payment
     */
    public function setGcCurrency($gc_currency)
    {
        $this->gc_currency = $gc_currency;

        return $this;
    }

    /**
     * Get gc_currency
     *
     * @return string 
     */
    public function getGcCurrency()
    {
        return $this->gc_currency;
    }


    /**
     * Set gc_description
     *
     * @param string $gc_description
     * @return Payment
     */
    public function setGcDescription($gc_description)
    {
        $this->gc_description = $gc_description;

        return $this;
    }

    /**
     * Get gc_iban
     *
     * @return string 
     */
    public function getGcDescription()
    {
        return $this->gc_description;
    }

    /**
     * Set gc_charge_date
     *
     * @param string $gc_charge_date
     * @return Payment
     */
    public function setGcChargeDate($gc_charge_date)
    {
        $this->gc_charge_date = $gc_charge_date;

        return $this;
    }

    /**
     * Get gc_charge_date
     *
     * @return string 
     */
    public function getGcChargeDate()
    {
        return $this->gc_charge_date;
    }


    /**
     * Set gc_status
     *
     * @param string $gc_status
     * @return Payment
     */
    public function setGcStatus($gc_status)
    {
        $this->gc_status = $gc_status;

        return $this;
    }

    /**
     * Get gc_status
     *
     * @return string 
     */
    public function getGcStatus()
    {
        return $this->gc_status;
    }

    /**
     * Set subscription
     *
     * @param string $subscription
     * @return Payment
     */
    public function setSubscription($subscription)
    {
        $this->subscription = $subscription;

        return $this;
    }

    /**
     * Get subscription
     *
     * @return string 
     */
    public function getSubscription()
    {
        return $this->subscription;
    }

    /**
     * Set created
     *
     * @param string $created
     * @return Payment
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set created
     *
     * @param string $created
     * @return Payment
     */
    public function setUpdated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getUpdated()
    {
        return $this->created;
    }
    /**
     * Set posted_by
     *
     * @param string $posted_by
     * @return Payment
     */
    public function setPostedBy($posted_by)
    {
        $this->posted_by = $posted_by;

        return $this;
    }

    /**
     * Get posted_by
     *
     * @return string 
     */
    public function getPostedBy()
    {
        return $this->posted_by;
    }

}