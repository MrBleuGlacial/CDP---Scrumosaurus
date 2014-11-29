<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
        $this->call('PositionSeeder');

        $this->command->info('Positions table seeded!');
	}

}

class PositionSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert(array(
            array('login'=>'dranc','password'=>'$2y$10$uYIHr88SR1AhXUwD7q4gG.qHeHw5.Zj19Ff8QS7DYnk4XkxivmknC','name'=>'Ranc','lastname'=>'Dimitri', 'email'=>'ranc.dimitri@gmail.com'),
            array('login'=>'meychenie','password'=>'$2y$10$uYIHr88SR1AhXUwD7q4gG.qHeHw5.Zj19Ff8QS7DYnk4XkxivmknC','name'=>'Eychenié','lastname'=>'Maxime', 'email'=>'maxime.eychenie@outlook.com'),
            array('login'=>'alaumond','password'=>'$2y$10$uYIHr88SR1AhXUwD7q4gG.qHeHw5.Zj19Ff8QS7DYnk4XkxivmknC','name'=>'Laumond','lastname'=>'Antoine', 'email'=>'bleuglacial@gmail.com')
        ));

        DB::table('projects')->delete();
        DB::table('projects')->insert(array(
            array('name'=>'Scrumosaurus','description'=>"Dans le cadre de l'UE Gestion de projet, nous devons créer un site permettant la gestion de projet.", 'start'=>'2014-10-21 12:15:00', 'end'=>'2014-12-09 10:15:00', 'in_progress'=>0, 'git'=>'https://github.com/MrBleuGlacial/CDP---Scrumosaurus')
        ));

        DB::table('workingon')->delete();
        DB::table('workingon')->insert(array(
            array('user_id'=>1, 'project_id'=>1,'position_id'=>1),
            array('user_id'=>2, 'project_id'=>1,'position_id'=>1),
            array('user_id'=>3, 'project_id'=>1,'position_id'=>1)
        ));

        DB::table('sprints')->delete();
        DB::table('sprints')->insert(array(
            array('project_id'=>1,'number'=>1,'begin'=>'2014-10-28 12:15:00','duration'=>5),
            array('project_id'=>1,'number'=>2,'begin'=>'2014-11-04 12:15:00','duration'=>5),
            array('project_id'=>1,'number'=>3,'begin'=>'2014-11-11 12:15:00','duration'=>5),
            array('project_id'=>1,'number'=>4,'begin'=>'2014-11-25 12:15:00','duration'=>5),
            array('project_id'=>1,'number'=>5,'begin'=>'2014-11-02 12:15:00','duration'=>5)
        ));

        DB::table('userstories')->delete();
        DB::table('userstories')->insert(array(
            /** SPRINT 1 */
            array('project_id'=>1, 'sprint_id'=>1, 'number'=>1, 'difficulty'=>8, 'priority'=>2, 'description'=>"En tant que visiteur, je veux pouvoir m'enregistrer sur l'outil Scrum pour gérer des projets."),
            array('project_id'=>1, 'sprint_id'=>1, 'number'=>2, 'difficulty'=>1, 'priority'=>2, 'description'=>"En tant qu'utilisateur, je veux pouvoir me connecter et me déconnecter à mon compte."),
            array('project_id'=>1, 'sprint_id'=>1, 'number'=>3, 'difficulty'=>3, 'priority'=>5, 'description'=>"En tant qu'utilisateur, je veux pouvoir créer un projet et en devenir le product owner."),
            array('project_id'=>1, 'sprint_id'=>1, 'number'=>4, 'difficulty'=>1, 'priority'=>3, 'description'=>"En tant qu'utilisateur, je veux pouvoir lister mes projets."),
            array('project_id'=>1, 'sprint_id'=>1, 'number'=>5, 'difficulty'=>2, 'priority'=>5, 'description'=>"En tant qu'utilisateur, je veux pouvoir modifier ou supprimer un projet."),
            array('project_id'=>1, 'sprint_id'=>1, 'number'=>6, 'difficulty'=>3, 'priority'=>3, 'description'=>"En tant qu'utilisateur, je veux pouvoir créer des User Stories dans le Backlog."),
            /** SPRINT 2 */
            array('project_id'=>1, 'sprint_id'=>2, 'number'=>8, 'difficulty'=>1, 'priority'=>1, 'description'=>"En tant qu'utilisateur, je veux pouvoir afficher le Backlog pour connaitre les User Stories."),
            array('project_id'=>1, 'sprint_id'=>2, 'number'=>9, 'difficulty'=>2, 'priority'=>5, 'description'=>"En tant qu'utilisateur, je veux pouvoir modifier et supprimer des User Stories dans le Backlog."),
            array('project_id'=>1, 'sprint_id'=>2, 'number'=>10, 'difficulty'=>3, 'priority'=>2, 'description'=>"En tant qu'utilisateur, je veux pouvoir ajouter des tâches dans les User Stories."),
            array('project_id'=>1, 'sprint_id'=>2, 'number'=>11, 'difficulty'=>1, 'priority'=>3, 'description'=>"En tant qu'utilisateur, je veux pouvoir lister les tâches d'une User Story."),
            array('project_id'=>1, 'sprint_id'=>2, 'number'=>12, 'difficulty'=>2, 'priority'=>5, 'description'=>"En tant qu'utilisateur, je veux pouvoir modifier et supprimer des tâches dans les User Stories."),
            array('project_id'=>1, 'sprint_id'=>2, 'number'=>13, 'difficulty'=>1, 'priority'=>5, 'description'=>"En tant qu'utilisateur, je veux pouvoir définir un ordre de priorité dans les tâches d'une User Story."),
            array('project_id'=>1, 'sprint_id'=>2, 'number'=>14, 'difficulty'=>1, 'priority'=>1, 'description'=>"En tant qu'utilisateur, je veux pouvoir choisir la difficulté d'une User Story."),
            array('project_id'=>1, 'sprint_id'=>2, 'number'=>15, 'difficulty'=>1, 'priority'=>1, 'description'=>"En tant qu'utilisateur, je veux pouvoir choisir la priorité d'une User Story."),
            array('project_id'=>1, 'sprint_id'=>2, 'number'=>16, 'difficulty'=>3, 'priority'=>2, 'description'=>"En tant qu'utilisateur, je veux pouvoir créer un Sprint et y ajouter des User Stories."),
            array('project_id'=>1, 'sprint_id'=>2, 'number'=>17, 'difficulty'=>1, 'priority'=>3, 'description'=>"En tant qu'utilisateur, je veux pouvoir lister les Sprints et afficher les User Stories présentent dans le Sprint."),
            array('project_id'=>1, 'sprint_id'=>2, 'number'=>18, 'difficulty'=>2, 'priority'=>5, 'description'=>"En tant qu'utilisateur, je veux pouvoir modifier et supprimer un Sprint."),
            array('project_id'=>1, 'sprint_id'=>3, 'number'=>24, 'difficulty'=>2, 'priority'=>8, 'description'=>"En tant que product owner, je veux pouvoir ajouter des utilisateurs et leur assigner un rang (Product Owner, Scrum Master, Développeur)."),
            array('project_id'=>1, 'sprint_id'=>3, 'number'=>25, 'difficulty'=>5, 'priority'=>5, 'description'=>"En tant qu'utilisateur, je veux pouvoir accéder au Kanban du Sprint."),
            /** SPRINT 4 */
            array('project_id'=>1, 'sprint_id'=>4, 'number'=>26, 'difficulty'=>8, 'priority'=>8, 'description'=>"En tant qu'utilisateur, je veux pouvoir accéder au Pert du Sprint."),
            array('project_id'=>1, 'sprint_id'=>4, 'number'=>27, 'difficulty'=>2, 'priority'=>8, 'description'=>"En tant qu'utilisateur, je veux pouvoir faire avancer les tâches sur le Kanban en validant une User Story (en dev ou validée)."),
            array('project_id'=>1, 'sprint_id'=>4, 'number'=>28, 'difficulty'=>8, 'priority'=>8, 'description'=>"En tant qu'utilisateur, je veux pouvoir accéder au BurnDown Chart du Sprint."),
            array('project_id'=>1, 'sprint_id'=>4, 'number'=>29, 'difficulty'=>3, 'priority'=>5, 'description'=>"En tant qu'utilisateur, je veux pouvoir ajouter un test au projet."),
            array('project_id'=>1, 'sprint_id'=>4, 'number'=>30, 'difficulty'=>1, 'priority'=>3, 'description'=>"En tant qu'utilisateur, je veux pouvoir voir la liste des tests."),
            array('project_id'=>1, 'sprint_id'=>4, 'number'=>31, 'difficulty'=>2, 'priority'=>5, 'description'=>"En tant qu'utilisateur, je veux pouvoir modifier ou supprimer un test."),
            /** SPRINT 5 */
            array('project_id'=>1, 'sprint_id'=>5, 'number'=>32, 'difficulty'=>8, 'priority'=>8, 'description'=>"En tant qu'utilisateur, je veux pouvoir consulter des informations sur la répartition des tâches dans les sprints via des diagrammes circulaires."),
            array('project_id'=>1, 'sprint_id'=>5, 'number'=>33, 'difficulty'=>1, 'priority'=>5, 'description'=>"En tant qu'utilisateur, je veux pouvoir savoir quand, par qui et si les tests ont fonctionné pour la dernière fois."),
            array('project_id'=>1, 'sprint_id'=>5, 'number'=>34, 'difficulty'=>1, 'priority'=>3, 'description'=>"En tant qu'utilisateur, je veux pouvoir afficher les informations d'un projet (membres, etc).")
        ));
        DB::table('userstories')->insert(array(
            /** US mise de cote pour le moment */
            array('project_id'=>1, 'number'=>35, 'difficulty'=>8, 'priority'=>8, 'description'=>"En tant qu'utilisateur, je veux pouvoir automatiser le lancement des tests ou accéder à la zone de code correspondante sur le GIT."),
            array('project_id'=>1, 'number'=>36, 'difficulty'=>5, 'priority'=>5, 'description'=>"En tant que Scrum Master, je veux pouvoir faire le Daily Scrum et l'envoyer à tous les devs."),
            array('project_id'=>1, 'number'=>37, 'difficulty'=>3, 'priority'=>5, 'description'=>"En tant que Scrum Master, je veux pouvoir planifier une réunion et avertir tout le monde de la date de celle ci."),
            array('project_id'=>1, 'number'=>38, 'difficulty'=>2, 'priority'=>1, 'description'=>"En tant que visiteur, je souhaite demander mon mot de passe si je l'ai perdu."),
            array('project_id'=>1, 'number'=>39, 'difficulty'=>2, 'priority'=>1, 'description'=>"En tant qu'utilisateur, je souhaite pouvoir modifier mon profil.")
        ));

        DB::table('tasks')->delete();
        DB::table('tasks')->insert(array(
            /** US 1 */
            array('description'=>"Faire la base de donnée", 'status'=>2, 'userstory_id'=>1, 'dayfinished'=>1, 'user_id'=>1),
            array('description'=>"Créer vue formulaire enregistrement", 'status'=>2, 'userstory_id'=>1, 'dayfinished'=>3, 'user_id'=>2),
            array('description'=>"Créer modèle enregistrement", 'status'=>2, 'userstory_id'=>1, 'dayfinished'=>3, 'user_id'=>2),
            array('description'=>"Gérer erreur enregistrement (champs vide, login déjà utulisé ...)", 'status'=>2, 'userstory_id'=>1, 'dayfinished'=>3, 'user_id'=>2),
            array('description'=>"Intégrer la maquette", 'status'=>2, 'userstory_id'=>1, 'dayfinished'=>1, 'user_id'=>2),
            /** US 2 */
            array('description'=>"Créer formulaire connexion", 'status'=>2, 'userstory_id'=>2, 'dayfinished'=>3, 'user_id'=>2),
            array('description'=>"Créer modèle connexion", 'status'=>2, 'userstory_id'=>2, 'dayfinished'=>3, 'user_id'=>2),
            array('description'=>"Créer bouton déconnection", 'status'=>2, 'userstory_id'=>2, 'dayfinished'=>3, 'user_id'=>2),
            array('description'=>"Créer modèle déconnection", 'status'=>2, 'userstory_id'=>2, 'dayfinished'=>3, 'user_id'=>1),
            /** US 3 */
            array('description'=>"Créer formulaire création projet", 'status'=>2, 'userstory_id'=>3, 'dayfinished'=>1, 'user_id'=>3),
            array('description'=>"Créer modèle création projet", 'status'=>2, 'userstory_id'=>3, 'dayfinished'=>4, 'user_id'=>3),
            /** US 4 */
            array('description'=>"Création vue liste projet", 'status'=>2, 'userstory_id'=>4, 'dayfinished'=>4, 'user_id'=>3),
            /** US 5 */
            array('description'=>"Création modèle modification projet", 'status'=>2, 'userstory_id'=>5, 'dayfinished'=>5, 'user_id'=>3),
            array('description'=>"Création modèle suppression projet", 'status'=>2, 'userstory_id'=>5, 'dayfinished'=>5, 'user_id'=>3),
            /** US 6 */
            array('description'=>"Créer formulaire création US", 'status'=>2, 'userstory_id'=>8, 'dayfinished'=>5, 'user_id'=>1),
            array('description'=>"Créer modèle création US", 'status'=>2, 'userstory_id'=>8, 'dayfinished'=>5, 'user_id'=>1),
            /** US 7 */
            array('description'=>"Créer vue afficher détail projet", 'status'=>2, 'userstory_id'=>7, 'dayfinished'=>1, 'user_id'=>1),
            array('description'=>"Créer liste User Stories", 'status'=>2, 'userstory_id'=>7, 'dayfinished'=>1, 'user_id'=>1),
            /** US 9 */
            array('description'=>"Créer vue et modèle création de tache", 'status'=>2, 'userstory_id'=>9, 'dayfinished'=>4, 'user_id'=>3),
            /** US 10 */
            array('description'=>"Créer vue détail UserStory", 'status'=>2, 'userstory_id'=>10, 'dayfinished'=>1, 'user_id'=>1),
            /** US 11 */
            array('description'=>"Créer vue et modèle édition tache", 'status'=>2, 'userstory_id'=>11, 'dayfinished'=>5, 'user_id'=>3),
            array('description'=>"Créer modèle suppression tache", 'status'=>2, 'userstory_id'=>11, 'dayfinished'=>4, 'user_id'=>3),
            /** US 12 */
            array('description'=>"Créer modèle changement priorité", 'status'=>2, 'userstory_id'=>12, 'dayfinished'=>1, 'user_id'=>3),
            /** US 13 */
            array('description'=>"Créer modèle choix difficulté", 'status'=>2, 'userstory_id'=>13, 'dayfinished'=>3, 'user_id'=>1),
            /** US 14 */
            array('description'=>"Créer modèle choix priorité", 'status'=>2, 'userstory_id'=>14, 'dayfinished'=>1, 'user_id'=>4),
            /** US 15 */
            array('description'=>"Créer vue et modèle création Sprint", 'status'=>2, 'userstory_id'=>15, 'dayfinished'=>2, 'user_id'=>2),
            array('description'=>"Créer vue et modèle ajout US", 'status'=>2, 'userstory_id'=>15, 'dayfinished'=>2, 'user_id'=>2),
            /** US 16 */
            array('description'=>"Créer vue et modèle détail Sprint", 'status'=>2, 'userstory_id'=>16, 'dayfinished'=>5, 'user_id'=>2),
            /** US 17 */
            array('description'=>"Créer vue et modèle édition suppression Sprint", 'status'=>2, 'userstory_id'=>17, 'dayfinished'=>5, 'user_id'=>2),
            /** US 18 */
            array('description'=>"Création vue accès au GIT", 'status'=>2, 'userstory_id'=>18, 'dayfinished'=>4, 'user_id'=>2),
            /** US 22 */
            array('description'=>"Créer modèle et vue dépendance entre les tâches", 'status'=>2, 'userstory_id'=>22, 'dayfinished'=>2, 'user_id'=>1),
            /** US 24 */
            array('description'=>"Création vue ajout utilisateur", 'status'=>2, 'userstory_id'=>24, 'dayfinished'=>1, 'user_id'=>2),
            array('description'=>"Création modèle ajout utilisateur", 'status'=>2, 'userstory_id'=>24, 'dayfinished'=>1, 'user_id'=>2),
            /** US 25 */
            array('description'=>"Créer vue Kanban", 'status'=>2, 'userstory_id'=>25, 'dayfinished'=>3, 'user_id'=>2),
            array('description'=>"Créer modèle Kanban", 'status'=>2, 'userstory_id'=>25, 'dayfinished'=>4, 'user_id'=>1),

            /** US 27 */
            array('description'=>"Lier l'attribut statut des US au Kanban pour afficher les tâches au bon endroit", 'status'=>2, 'userstory_id'=>27, 'dayfinished'=>2, 'user_id'=>2),

            /** US 28 */
            array('description'=>"Mise à jours des tâches pour prise en compte du BDC", 'status'=>2, 'userstory_id'=>28, 'dayfinished'=>1, 'user_id'=>2),

            /** US 29 */
            array('description'=>"Création de la vue d'ajout des tests", 'status'=>2, 'userstory_id'=>29, 'dayfinished'=>2, 'user_id'=>1),
            array('description'=>"Création du modèle d'ajout des tests", 'status'=>2, 'userstory_id'=>29, 'dayfinished'=>2, 'user_id'=>1),

            /** US 30 */
            array('description'=>"Création des liens vers les tests et de la liste", 'status'=>2, 'userstory_id'=>30, 'dayfinished'=>2, 'user_id'=>1),

        ));
        DB::table('tasks')->insert(array(
            /** US 26 */
            array('description'=>"Insertion du script/vue du Pert", 'status'=>0, 'userstory_id'=>26, 'user_id'=>3),
            /** US 28 */
            array('description'=>"Création Modèle", 'status'=>0, 'userstory_id'=>28, 'user_id'=>3),
            array('description'=>"Création Vue", 'status'=>0, 'userstory_id'=>28, 'user_id'=>3),
            array('description'=>"Insertion", 'status'=>0, 'userstory_id'=>28, 'user_id'=>3),
            /** US 31 */
            array('description'=>"Création des vues de modification et suppression des tests", 'status'=>0, 'userstory_id'=>31, 'user_id'=>2),
            array('description'=>"Création du modèle de modification et suppression des tests", 'status'=>0, 'userstory_id'=>31, 'user_id'=>2)
        ));

        DB::table('tests')->delete();
        DB::table('tests')->insert(array(
            /** SPRINT 1 */
            array('user_id'=>1, 'userstory_id'=>1, 'description'=>"Tester l'enregistrement (enregistrement valide et non)", 'result'=>"RAS", 'works'=>true, 'date'=>'2014-10-30 10:15:00'),
            array('user_id'=>1, 'userstory_id'=>2, 'description'=>"Tester la connexion", 'result'=>"RAS", 'works'=>true, 'date'=>'2014-10-30 18:46:46'),
            array('user_id'=>1, 'userstory_id'=>3, 'description'=>"Tester création projet", 'result'=>"RAS", 'works'=>true, 'date'=>'2014-10-31 22:15:00'),
            array('user_id'=>3, 'userstory_id'=>5, 'description'=>"Tester modification projet", 'result'=>"RAS", 'works'=>true, 'date'=>'2014-11-03 10:56:00'),
            array('user_id'=>3, 'userstory_id'=>5, 'description'=>"Tester suppression projet", 'result'=>"RAS", 'works'=>true, 'date'=>'2014-11-03 13:15:00'),
            array('user_id'=>1, 'userstory_id'=>6, 'description'=>"Tester création US", 'result'=>"RAS", 'works'=>true, 'date'=>'2014-11-03 14:15:00'),
            /** SPRINT 2 */
            array('description'=>"Tester ajout, suppression édition", 'user_id'=>2, 'userstory_id'=>8, 'result'=>"RAS", 'works'=>true, 'date'=>'2014-11-04 14:15:00'),
            array('description'=>"Test ajout tache", 'user_id'=>3, 'userstory_id'=>9, 'result'=>"RAS", 'works'=>true, 'date'=>'2014-11-07 14:15:00'),
            array('description'=>"Test édition, suppression tache", 'user_id'=>3, 'userstory_id'=>11, 'result'=>"RAS", 'works'=>true, 'date'=>'2014-11-07 14:15:00'),
            array('description'=>"Tester création Sprint", 'user_id'=>1, 'userstory_id'=>15, 'result'=>"RAS", 'works'=>true, 'date'=>'2014-11-07 14:15:00'),
            array('description'=>"Tester édition suppression Sprint", 'user_id'=>1, 'userstory_id'=>15, 'result'=>"RAS", 'works'=>true, 'date'=>'2014-11-07 14:15:00'),
            array('description'=>"Tester modèle ajout US", 'user_id'=>2, 'userstory_id'=>21, 'result'=>"RAS", 'works'=>true, 'date'=>'2014-11-08 14:15:00'),
            /** SPRINT 3 */
            array('description'=>"Test édition, suppression tache", 'userstory_id'=>21, 'result'=>"RAS", 'works'=>true, 'date'=>'2014-11-11 14:15:00', 'user_id'=>1),
            array('description'=>"Tester dépendance entre les tâches", 'userstory_id'=>22, 'result'=>"RAS", 'works'=>true, 'date'=>'2014-11-13 14:15:00', 'user_id'=>3),
            array('description'=>"Tester édition suppression Sprint", 'userstory_id'=>23, 'result'=>"RAS", 'works'=>true, 'date'=>'2014-11-17 14:15:00', 'user_id'=>1),
            array('description'=>"Tester ajout d'utilisateur", 'userstory_id'=>24, 'result'=>"RAS", 'works'=>true, 'date'=>'2014-11-14 14:15:00', 'user_id'=>1),
            /** SPRINT 4 */
            array('description'=>"Test du Kanban", 'userstory_id'=>27, 'result'=>"RAS", 'works'=>true, 'date'=>'2014-11-26 14:15:00', 'user_id'=>2),
            array('description'=>"Tester l'ajout de tests", 'userstory_id'=>29, 'result'=>"RAS", 'works'=>true, 'date'=>'2014-11-26 14:15:00', 'user_id'=>1),
        ));
        DB::table('tests')->insert(array(
            /** SPRINT 4 */
            array('description'=>"Tester la modification/suppression des tests", 'userstory_id'=>31, 'works'=>false, 'user_id'=>2),
        ));
    }

}