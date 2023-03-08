<?php

namespace App\Test\Controller;

use App\Entity\Consultation;
use App\Repository\ConsultationRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConsultationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ConsultationRepository $repository;
    private string $path = '/consultation/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Consultation::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Consultation index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'consultation[lien_visio]' => 'Testing',
            'consultation[prix]' => 'Testing',
            'consultation[lien_enregistrement]' => 'Testing',
            'consultation[consul]' => 'Testing',
        ]);

        self::assertResponseRedirects('/consultation/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Consultation();
        $fixture->setLien_visio('My Title');
        $fixture->setPrix('My Title');
        $fixture->setLien_enregistrement('My Title');
        $fixture->setConsul('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Consultation');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Consultation();
        $fixture->setLien_visio('My Title');
        $fixture->setPrix('My Title');
        $fixture->setLien_enregistrement('My Title');
        $fixture->setConsul('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'consultation[lien_visio]' => 'Something New',
            'consultation[prix]' => 'Something New',
            'consultation[lien_enregistrement]' => 'Something New',
            'consultation[consul]' => 'Something New',
        ]);

        self::assertResponseRedirects('/consultation/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getLien_visio());
        self::assertSame('Something New', $fixture[0]->getPrix());
        self::assertSame('Something New', $fixture[0]->getLien_enregistrement());
        self::assertSame('Something New', $fixture[0]->getConsul());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Consultation();
        $fixture->setLien_visio('My Title');
        $fixture->setPrix('My Title');
        $fixture->setLien_enregistrement('My Title');
        $fixture->setConsul('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/consultation/');
    }
}
