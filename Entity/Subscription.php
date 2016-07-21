<?php
// src/SIAPEP/SubscriptionBundle/Entity/Subscription.php
 
namespace SIAPEP\GocardlessBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use SIAPEP\GocardlessBundle\Entity\Payment;
use Doctrine\Common\Collections\ArrayCollection;
 
/**
 * @ORM\Entity(repositoryClass="SubscriptionRepository")
 * @ORM\Table(name="siapep_gocardless_bundle_subscription")
 */

class Subscription
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
     * @ORM\Column(name="gc_id", type="string", length=255)
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
     * @ORM\Column(name="local_subscription", type="string", length=30)
     */
    protected $local_subscription;

    /**
     * @var datetime
     *
     * @ORM\Column(name="gc_created_at", type="datetime")
     */
    protected $gc_created_at;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_amount", type="string", length=6)
     */
    
    private $gc_amount;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_currency", type="string", length=6)
     */
    
    private $gc_currency;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_status", type="string", length=255)
     */
    
    private $gc_status;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_name", type="string", length=255)
     */
    
    private $gc_name;

    /**
     * @var datetime
     *
     * @ORM\Column(name="gc_start_date", type="datetime")
     */
    
    private $gc_start_date;

    /**
     * @var datetime
     *
     * @ORM\Column(name="gc_end_date", type="datetime", nullable=true)
     */
    
    private $gc_end_date;

    /**
     * @var integer
     *
     * @ORM\Column(name="gc_interval", type="integer", length=11)
     */
    
    private $gc_interval;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_interval_unit", type="string", length=255)
     */
    
    private $gc_interval_unit;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_day_of_month", type="string", length=255)
     */
    
    private $gc_day_of_month;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_month", type="string", length=255)
     */
    
    private $gc_month;

    /**
     * @var string
     *
     * @ORM\Column(name="gc_payment_reference", type="string", length=255)
     */
    
    private $gc_payment_reference;

    /*
     *
     * @ORM\OneToMany(targetEntity="SIAPEP\GocardlessBundle\Entity\Payment", mappedBy="subscription", nullable=true)
     *
     */
    
    private $gc_payments;

    /**
     * @ORM\ManyToOne(targetEntity="SIAPEP\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="posted_by", referencedColumnName="id", nullable=false)
     */

    private $posted_by;

    /**
     * @var string
     *
     * @ORM\Column(name="posted_from", type="string")
     */
    
    private $posted_from;

    /**
     * @var string
     *
     * @ORM\Column(name="created", type="datetime")
     */
    
    private $created;

    /**
     * @var datetime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    
    private $updated;
    
 
    public function __construct()
    {
        // your own logic
        $this->created = new \Datetime();
        $this->payments = new ArrayCollection();
        $this->posted_from = 'back_office';
    }

    /**
     * Set id
     *
     * @param string $id
     * @return Subscription
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
     * @return Subscription
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
     * @return Subscription
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
     * Set local_subscription
     *
     * @param string $local_subscription
     * @return Subscription
     */
    public function setLocalSubscription($local_subscription)
    {
        $this->local_subscription = $local_subscription;

        return $this;
    }

    /**
     * Get local_subscription
     *
     * @return string 
     */
    public function getLocalSubscription()
    {
        return $this->local_subscription;
    }

    /**
     * Set gc_created_at
     *
     * @param datetime $gc_created_at
     * @return Subscription
     */
    public function setGcCreatedAt($gc_created_at)
    {
        $this->gc_created_at = $gc_created_at;

        return $this;
    }

    /**
     * Get gc_created_at
     *
     * @return string 
     */
    public function getGcCreatedAt()
    {
        return $this->gc_created_at;
    }

    /**
     * Set gc_amount
     *
     * @param string $gc_amount
     * @return Subscription
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
     * @return Subscription
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
     * Set gc_status
     *
     * @param string $gc_status
     * @return Subscription
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
     * Set gc_name
     *
     * @param string $gc_name
     * @return Subscription
     */
    public function setGcName($gc_name)
    {
        $this->gc_name = $gc_name;

        return $this;
    }

    /**
     * Get gc_name
     *
     * @return string 
     */
    public function getGcName()
    {
        return $this->gc_name;
    }

    /**
     * Set gc_start_date
     *
     * @param string $gc_start_date
     * @return Subscription
     */
    public function setGcStartDate($gc_start_date)
    {
        $this->gc_start_date = $gc_start_date;

        return $this;
    }

    /**
     * Get gc_start_date
     *
     * @return string 
     */
    public function getGcStartDate()
    {
        return $this->gc_start_date;
    }

    /**
     * Set gc_end_date
     *
     * @param string $gc_end_date
     * @return Subscription
     */
    public function setGcEndDate($gc_end_date)
    {
        $this->gc_end_date = $gc_end_date;

        return $this;
    }

    /**
     * Get gc_end_date
     *
     * @return string 
     */
    public function getGcEndDate()
    {
        return $this->gc_end_date;
    }

    /**
     * Set gc_interval
     *
     * @param integer $gc_interval
     * @return Subscription
     */
    public function setGcInterval($gc_interval)
    {
        $this->gc_interval = $gc_interval;

        return $this;
    }

    /**
     * Get gc_interval
     *
     * @return integer 
     */
    public function getGcInterval()
    {
        return $this->gc_interval;
    }

    /**
     * Set gc_interval_unit
     *
     * @param string $gc_interval_unit
     * @return Subscription
     */
    public function setGcIntervalUnit($gc_interval_unit)
    {
        $this->gc_interval_unit = $gc_interval_unit;

        return $this;
    }

    /**
     * Get gc_interval_unit
     *
     * @return string 
     */
    public function getGcIntervalUnit()
    {
        return $this->gc_interval_unit;
    }

    /**
     * Set gc_day_of_month
     *
     * @param string $gc_day_of_month
     * @return Subscription
     */
    public function setGcDayOfMonth($gc_day_of_month)
    {
        $this->gc_day_of_month = $gc_day_of_month;

        return $this;
    }

    /**
     * Get gc_day_of_month
     *
     * @return string 
     */
    public function getGcDayOfMonth()
    {
        return $this->gc_day_of_month;
    }

    /**
     * Set gc_month
     *
     * @param string $gc_month
     * @return Subscription
     */
    public function setGcMonth($gc_month)
    {
        $this->gc_month = $gc_month;

        return $this;
    }

    /**
     * Get gc_month
     *
     * @return string 
     */
    public function getGcMonth()
    {
        return $this->gc_month;
    }

    /**
     * Set gc_payment_reference
     *
     * @param string $gc_payment_reference
     * @return Subscription
     */
    public function setGcPaymentReference($gc_payment_reference)
    {
        $this->gc_payment_reference = $gc_payment_reference;

        return $this;
    }

    /**
     * Get gc_payment_reference
     *
     * @return string 
     */
    public function getGcPaymentReference()
    {
        return $this->gc_payment_reference;
    }

    /**
     * Add gc_payment
     *
     * @param SIAPEP\GocardlessBundle\Entity\Payment $gc_payment
     * @return Subscription
     */

    public function addPayment(Payment $gc_payment)
    {
        $this->gc_payments[] = $gc_payment;
        return $this;
    }

    public function removePayment(Payment $gc_payment)
    {
        $this->gc_payments->removeElement($gc_payment);
    }

    /**
     * Get gc_payments
     *
     * @return collection 
     */
    public function getPayments()
    {
        return $this->gc_payments;
    }

    /**
     * Set posted_by
     *
     * @param string $posted_by
     * @return Subscription
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

    /**
     * Set posted_from
     *
     * @param string $posted_from
     * @return Subscription
     */
    public function setPostedFrom($posted_from)
    {
        $this->posted_from = $posted_from;

        return $this;
    }

    /**
     * Get posted_from
     *
     * @return string 
     */
    public function getPostedFrom()
    {
        return $this->posted_from;
    }

    /**
     * Set created
     *
     * @param string $created
     * @return Subscription
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return string 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param string $updated
     * @return Subscription
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return string 
     */
    public function getUpdated()
    {
        return $this->updated;
    }
    
}