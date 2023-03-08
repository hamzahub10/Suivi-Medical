<?php

namespace App\Test\Controller;

use App\Entity\Ordonnance;
use App\Repository\OrdonnanceRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrdonnanceControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private OrdonnanceRepository $repository;
    private string $path = '/ordonnance/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Ordonnance::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Ordonnance index');

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
            'ordonnance[date]' => 'Testing',
            'ordonnance[nb_paquet]' => 'Testing',
            'ordonnance[dosage]' => 'Testing',
            'ordonnance[remarque]' => 'Testing',
            'ordonnance[ord]' => 'Testing',
            'ordonnance[ord_user]' => 'Testing',
        ]);

        self::assertResponseRedirects('/ordonnance/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Ordonnance();
        $fixture->setDate('My Title');
        $fixture->setNb_paquet('My Title');
        $fixture->setDosage('My Title');
        $fixture->setRemarque('My Title');
        $fixture->setOrd('My Title');
        $fixture->setOrd_user('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Ordonnance');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Ordonnance();
        $fixture->setDate('My Title');
        $fixture->setNb_paquet('My Title');
        $fixture->setDosage('My Title');
        $fixture->setRemarque('My Title');
        $fixture->setOrd('My Title');
        $fixture->setOrd_user('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'ordonnance[date]' => 'Something New',
            'ordonnance[nb_paquet]' => 'Something New',
            'ordonnance[dosage]' => 'Something New',
            'ordonnance[remarque]' => 'Something New',
            'ordonnance[ord]' => 'Something New',
            'ordonnance[ord_user]' => 'Something New',
        ]);

        self::assertResponseRedirects('/ordonnance/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDate());
        self::assertSame('Something New', $fixture[0]->getNb_paquet());
        self::assertSame('Something New', $fixture[0]->getDosage());
        self::assertSame('Something New', $fixture[0]->getRemarque());
        self::assertSame('Something New', $fixture[0]->getOrd());
        self::assertSame('Something New', $fixture[0]->getOrd_user());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Ordonnance();
        $fixture->setDate('My Title');
        $fixture->setNb_paquet('My Title');
        $fixture->setDosage('My Title');
        $fixture->setRemarque('My Title');
        $fixture->setOrd('My Title');
        $fixture->setOrd_user('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/ordonnance/');
    }
}
