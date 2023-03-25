<?php

namespace App\Test\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsersControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private UsersRepository $repository;
    private string $path = '/users/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Users::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('User index');

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
            'user[username]' => 'Testing',
            'user[password]' => 'Testing',
            'user[role]' => 'Testing',
            'user[name]' => 'Testing',
            'user[lastName]' => 'Testing',
            'user[email]' => 'Testing',
            'user[entryTime]' => 'Testing',
            'user[exitTime]' => 'Testing',
            'user[stops]' => 'Testing',
            'user[vacations]' => 'Testing',
            'user[workshops]' => 'Testing',
            'user[documents]' => 'Testing',
            'user[receiveNotifications]' => 'Testing',
        ]);

        self::assertResponseRedirects('/users/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Users();
        $fixture->setUsername('My Title');
        $fixture->setPassword('My Title');
        $fixture->setRole('My Title');
        $fixture->setName('My Title');
        $fixture->setLastName('My Title');
        $fixture->setEmail('My Title');
        $fixture->setEntryTime('My Title');
        $fixture->setExitTime('My Title');
        $fixture->setStops('My Title');
        $fixture->setVacations('My Title');
        $fixture->setWorkshops('My Title');
        $fixture->setDocuments('My Title');
        $fixture->setReceiveNotifications('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('User');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Users();
        $fixture->setUsername('My Title');
        $fixture->setPassword('My Title');
        $fixture->setRole('My Title');
        $fixture->setName('My Title');
        $fixture->setLastName('My Title');
        $fixture->setEmail('My Title');
        $fixture->setEntryTime('My Title');
        $fixture->setExitTime('My Title');
        $fixture->setStops('My Title');
        $fixture->setVacations('My Title');
        $fixture->setWorkshops('My Title');
        $fixture->setDocuments('My Title');
        $fixture->setReceiveNotifications('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'user[username]' => 'Something New',
            'user[password]' => 'Something New',
            'user[role]' => 'Something New',
            'user[name]' => 'Something New',
            'user[lastName]' => 'Something New',
            'user[email]' => 'Something New',
            'user[entryTime]' => 'Something New',
            'user[exitTime]' => 'Something New',
            'user[stops]' => 'Something New',
            'user[vacations]' => 'Something New',
            'user[workshops]' => 'Something New',
            'user[documents]' => 'Something New',
            'user[receiveNotifications]' => 'Something New',
        ]);

        self::assertResponseRedirects('/users/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getUsername());
        self::assertSame('Something New', $fixture[0]->getPassword());
        self::assertSame('Something New', $fixture[0]->getRole());
        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getLastName());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getEntryTime());
        self::assertSame('Something New', $fixture[0]->getExitTime());
        self::assertSame('Something New', $fixture[0]->getStops());
        self::assertSame('Something New', $fixture[0]->getVacations());
        self::assertSame('Something New', $fixture[0]->getWorkshops());
        self::assertSame('Something New', $fixture[0]->getDocuments());
        self::assertSame('Something New', $fixture[0]->getReceiveNotifications());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Users();
        $fixture->setUsername('My Title');
        $fixture->setPassword('My Title');
        $fixture->setRole('My Title');
        $fixture->setName('My Title');
        $fixture->setLastName('My Title');
        $fixture->setEmail('My Title');
        $fixture->setEntryTime('My Title');
        $fixture->setExitTime('My Title');
        $fixture->setStops('My Title');
        $fixture->setVacations('My Title');
        $fixture->setWorkshops('My Title');
        $fixture->setDocuments('My Title');
        $fixture->setReceiveNotifications('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/users/');
    }
}
