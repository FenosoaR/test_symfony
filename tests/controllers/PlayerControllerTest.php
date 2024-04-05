use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\Player;
use App\Repository\PlayerRepository;

class PlayerRepositoryTest extends KernelTestCase
{
    public function testInsertPlayer(): void
    {
        self::bootKernel();
        $container = self::$container;

        // Récupérer le EntityManager
        $entityManager = $container->get('doctrine')->getManager();

        // Créer une nouvelle instance de Player
        $player = new Player();
        $player->setNom('John Doe');
        $player->setNombreBut(10);
        $player->setParcours('Example Parcours');

        // Sauvegarder le joueur dans la base de données
        $entityManager->persist($player);
        $entityManager->flush();

        // Récupérer le PlayerRepository
        $playerRepository = $container->get(PlayerRepository::class);

        // Récupérer le joueur à partir de la base de données
        $savedPlayer = $playerRepository->findOneBy(['nom' => 'John Doe']);

        // Vérifier que le joueur a été correctement inséré
        $this->assertInstanceOf(Player::class, $savedPlayer);
        $this->assertEquals('John Doe', $savedPlayer->getNom());
        $this->assertEquals(10, $savedPlayer->getNombreBut());
        $this->assertEquals('Example Parcours', $savedPlayer->getParcours());
    }
}
