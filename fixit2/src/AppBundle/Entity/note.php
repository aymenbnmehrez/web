<?php


namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="note")
 */

class note
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $note_id;
    /**
     * @ORM\Column(type="integer")
     */
    private $note ;
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\user",inversedBy="note")
     * @ORM\JoinColumn(name="id",referencedColumnName="id")
     */
    private $client;
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\user",inversedBy="note")
     * @ORM\JoinColumn(name="id",referencedColumnName="id")
     */
    private $provider;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AskService",inversedBy="note")
     * @ORM\JoinColumn(name="ask_service_id",referencedColumnName="ask_service_id")
     */
    private $service ;

    /**
     * @return mixed
     */
    public function getNoteId()
    {
        return $this->note_id;
    }

    /**
     * @param mixed $note_id
     */
    public function setNoteId($note_id)
    {
        $this->note_id = $note_id;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param mixed $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

}