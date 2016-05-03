<?php
// src/SIAPEP/GocardlessBundle/Entity/Event.php
 
namespace SIAPEP\GocardlessBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
 
/**
 * @ORM\Entity(repositoryClass="EventRepository")
 * @ORM\Table(name="siapep_gocardless_bundle_event")
 */

class Event
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
     * @ORM\Column(name="event_id", type="string", length=255)
     */
    
    private $event_id;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=255)
     */
    
    private $action;

    /**
     * @var string
     *
     * @Gedmo\Timestampable(on="created_at")
     * @ORM\Column(type="datetime")
     */
    
    private $created_at;

    /**
     * @var string
     *
     * @ORM\Column(name="include", type="string", length=255, nullable=true)
     */
    
    private $include; /* payment /mandate / payout /subscription / refund */

    /**
     * @var string
     *
     * @ORM\Column(name="details_cause", type="string", length=255)
     */
    
    private $details_cause;

    /**
     * @var string
     *
     * @ORM\Column(name="details_description", type="string", length=255)
     */
    
    private $details_description;

    /**
     * @var string
     *
     * @ORM\Column(name="details_origin", type="string", length=255)
     */
    
    private $details_origin;

    /**
     * @var string
     *
     * @ORM\Column(name="details_reason_code", type="string", length=255, nullable=true)
     */
    
    private $details_reason_code;

    /**
     * @var string
     *
     * @ORM\Column(name="details_scheme", type="string", length=255, nullable=true)
     */
    
    private $details_scheme;

    /**
     * @var string
     *
     * @ORM\Column(name="resource_type", type="string", length=255, nullable=true)
     */
    
    private $resource_type; /* payments /mandates / payouts /subscriptions / refunds */

    /**
     * @var string
     *
     * @ORM\Column(name="links_mandate", type="string", length=255, nullable=true)
     */
    
    private $links_mandate;

    /**
     * @var string
     *
     * @ORM\Column(name="links_new_customer_bank_account", type="string", length=255, nullable=true)
     */
    
    private $links_new_customer_bank_account;

    /**
     * @var string
     *
     * @ORM\Column(name="links_organisation", type="string", length=255, nullable=true)
     */
    
    private $links_organisation;

    /**
     * @var string
     *
     * @ORM\Column(name="links_parent_event", type="string", length=255, nullable=true)
     */
    
    private $links_parent_event;

    /**
     * @var string
     *
     * @ORM\Column(name="links_payment", type="string", length=255, nullable=true)
     */
    
    private $links_payment;

    /**
     * @var string
     *
     * @ORM\Column(name="links_payout", type="string", length=255, nullable=true)
     */
    
    private $links_payout;

    /**
     * @var string
     *
     * @ORM\Column(name="links_previous_customer_bank_account", type="string", length=255, nullable=true)
     */
    
    private $links_previous_customer_bank_account;

    /**
     * @var string
     *
     * @ORM\Column(name="links_refund", type="string", length=255, nullable=true)
     */
    
    private $links_refund;

    /**
     * @var string
     *
     * @ORM\Column(name="links_subscription", type="string", length=255, nullable=true)
     */
    
    private $links_subscription;

    /**
     * @var string
     *
     * @ORM\Column(name="import_process", type="string", length=255)
     */
    
    private $import_process;/* manually or from_webhook or application */

    /**
     * @var string
     *
     * @ORM\Column(name="webhook", type="string", length=355, nullable=true)
     */
    
    private $webhook;

    /**
     * @var string
     *
     * @ORM\Column(name="imported", type="datetime")
     */
    
    private $imported;

    /**
     * @ORM\ManyToOne(targetEntity="SIAPEP\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="posted_by", referencedColumnName="id", nullable=false)
     */

    private $posted_by;
 
    public function __construct()
    {
        // your own logic
        $this->imported = new \Datetime();
        $this->import_process = 'from_webhook';
    }

    /**
     * Set id
     *
     * @param string $id
     * @return Event
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
     * Set event_id
     *
     * @param string $event_id
     * @return Event
     */
    public function setEventIt($event_id)
    {
        $this->event_id = $event_id;

        return $this;
    }

    /**
     * Get event_id
     *
     * @return string 
     */
    public function getEventIt()
    {
        return $this->event_id;
    }

    /**
     * Set action
     *
     * @param string $action
     * @return Event
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set created_at
     *
     * @param string $created_at
     * @return Event
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return string 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set include
     *
     * @param string $include
     * @return Event
     */
    public function setInclude($include)
    {
        $this->include = $include;

        return $this;
    }

    /**
     * Get include
     *
     * @return string 
     */
    public function getInclude()
    {
        return $this->include;
    }

    /**
     * Set details_cause
     *
     * @param string $details_cause
     * @return Event
     */
    public function setDetailsCause($details_cause)
    {
        $this->details_cause = $details_cause;

        return $this;
    }

    /**
     * Get details_cause
     *
     * @return string 
     */
    public function getDetailsCause()
    {
        return $this->details_cause;
    }

    /**
     * Set details_description
     *
     * @param string $details_description
     * @return Event
     */
    public function setDetailsDescription($details_description)
    {
        $this->details_description = $details_description;

        return $this;
    }

    /**
     * Get details_description
     *
     * @return string 
     */
    public function getDetailsDescription()
    {
        return $this->details_description;
    }

    /**
     * Set details_origin
     *
     * @param string $details_origin
     * @return Event
     */
    public function setDetailsOrigin($details_origin)
    {
        $this->details_origin = $details_origin;

        return $this;
    }

    /**
     * Get details_origin
     *
     * @return string 
     */
    public function getDetailsOrigin()
    {
        return $this->details_origin;
    }

    /**
     * Set details_reason_code
     *
     * @param string $details_reason_code
     * @return Event
     */
    public function setDetailsReasonCode($details_reason_code)
    {
        $this->details_reason_code = $details_reason_code;

        return $this;
    }

    /**
     * Get details_reason_code
     *
     * @return string 
     */
    public function getDetailsReasonCode()
    {
        return $this->details_reason_code;
    }

    /**
     * Set details_scheme
     *
     * @param string $details_scheme
     * @return Event
     */
    public function setDetailsScheme($details_scheme)
    {
        $this->details_scheme = $details_scheme;

        return $this;
    }

    /**
     * Get details_scheme
     *
     * @return string 
     */
    public function getDetailsScheme()
    {
        return $this->details_scheme;
    }

    /**
     * Set resource_type
     *
     * @param string $resource_type
     * @return Event
     */
    public function setResourceType($resource_type)
    {
        $this->resource_type = $resource_type;

        return $this;
    }

    /**
     * Get resource_type
     *
     * @return string 
     */
    public function getResourceType()
    {
        return $this->resource_type;
    }

    /**
     * Set links_mandate
     *
     * @param string $links_mandate
     * @return Event
     */
    public function setLinksMandate($links_mandate)
    {
        $this->links_mandate = $links_mandate;

        return $this;
    }

    /**
     * Get links_mandate
     *
     * @return string 
     */
    public function getLinksMandate()
    {
        return $this->links_mandate;
    }

    /**
     * Set links_new_customer_bank_account
     *
     * @param string $links_new_customer_bank_account
     * @return Event
     */
    public function setLinksNewCustomerBankAccount($links_new_customer_bank_account)
    {
        $this->links_new_customer_bank_account = $links_new_customer_bank_account;

        return $this;
    }

    /**
     * Get links_new_customer_bank_account
     *
     * @return string 
     */
    public function getLinksNewCustomerBankAccount()
    {
        return $this->links_new_customer_bank_account;
    }

    /**
     * Set links_organisation
     *
     * @param string $links_organisation
     * @return Event
     */
    public function setLinksOrganisation($links_organisation)
    {
        $this->links_organisation = $links_organisation;

        return $this;
    }

    /**
     * Get links_organisation
     *
     * @return string 
     */
    public function getLinksOrganisation()
    {
        return $this->links_organisation;
    }

    /**
     * Set links_parent_event
     *
     * @param string $links_parent_event
     * @return Event
     */
    public function setLinksParentEvent($links_parent_event)
    {
        $this->links_parent_event = $links_parent_event;

        return $this;
    }

    /**
     * Get links_parent_event
     *
     * @return string 
     */
    public function getLinksParentEvent()
    {
        return $this->links_parent_event;
    }

    /**
     * Set links_payment
     *
     * @param string $links_payment
     * @return Event
     */
    public function setLinksPayment($links_payment)
    {
        $this->links_payment = $links_payment;

        return $this;
    }

    /**
     * Get links_payment
     *
     * @return string 
     */
    public function getLinksPayment()
    {
        return $this->links_payment;
    }

    /**
     * Set links_payout
     *
     * @param string $links_payout
     * @return Event
     */
    public function setLinksPayout($links_payout)
    {
        $this->links_payout = $links_payout;

        return $this;
    }

    /**
     * Get links_payout
     *
     * @return string 
     */
    public function getLinksPayout()
    {
        return $this->links_payout;
    }

    /**
     * Set links_previous_customer_bank_account
     *
     * @param string $links_previous_customer_bank_account
     * @return Event
     */
    public function setLinksPreviousCustomerBankAccount($created_at)
    {
        $this->links_previous_customer_bank_account = $links_previous_customer_bank_account;

        return $this;
    }

    /**
     * Get links_previous_customer_bank_account
     *
     * @return string 
     */
    public function getLinksPreviousCustomerBankAccount()
    {
        return $this->links_previous_customer_bank_account;
    }

    /**
     * Set links_refund
     *
     * @param string $links_refund
     * @return Event
     */
    public function setLinksRefund($links_refund)
    {
        $this->links_refund = $links_refund;

        return $this;
    }

    /**
     * Get links_refund
     *
     * @return string 
     */
    public function getLinksRefund()
    {
        return $this->links_refund;
    }

    /**
     * Set links_subscription
     *
     * @param string $links_subscription
     * @return Event
     */
    public function setLinksSubscription($links_subscription)
    {
        $this->links_subscription = $links_subscription;

        return $this;
    }

    /**
     * Get links_subscription
     *
     * @return string 
     */
    public function getLinksSubscription()
    {
        return $this->links_subscription;
    }

    /**
     * Set import_process
     *
     * @param string $import_process
     * @return Event
     */
    public function setImportProcess($import_process)
    {
        $this->import_process = $import_process;

        return $this;
    }

    /**
     * Get import_process
     *
     * @return string 
     */
    public function getImportProcess()
    {
        return $this->import_process;
    }

    /**
     * Set webhook
     *
     * @param string $webhook
     * @return Event
     */
    public function setWebhook($webhook)
    {
        $this->webhook = $webhook;

        return $this;
    }

    /**
     * Get webhook
     *
     * @return string 
     */
    public function getWebhook()
    {
        return $this->webhook;
    }

    /**
     * Set imported
     *
     * @param string $imported
     * @return Event
     */
    public function setImported($imported)
    {
        $this->imported = $imported;

        return $this;
    }

    /**
     * Get imported
     *
     * @return string 
     */
    public function getImported()
    {
        return $this->imported;
    }

    /**
     * Set posted_by
     *
     * @param string $posted_by
     * @return Event
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