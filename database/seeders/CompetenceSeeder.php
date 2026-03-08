<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Competence;
use App\Models\SousCompetence;

class CompetenceSeeder extends Seeder
{
    public function run(): void
    {
        $competences = [
            [
                'slug'              => 'patrimoine-informatique',
                'intitule'          => 'Gérer le patrimoine informatique',
                'intitule_court'    => 'Patrimoine Info.',
                'description_courte'=> 'Recenser, inventorier et maintenir les équipements et logiciels.',
                'icone'             => '🗄️',
                'ordre'             => 1,
                'sous_competences'  => [
                    'Recenser et identifier les ressources numériques',
                    'Exploiter des référentiels, normes et standards',
                    'Mettre en place et vérifier les niveaux d\'habilitation associés',
                    'Vérifier les conditions de la continuité d\'un service informatique',
                    'Gérer des sauvegardes',
                    'Vérifier le respect des règles d\'utilisation des ressources numériques',
                ],
            ],
            [
                'slug'              => 'incidents-assistance',
                'intitule'          => 'Répondre aux incidents et aux demandes d\'assistance et d\'évolution',
                'intitule_court'    => 'Incidents & Assistance',
                'description_courte'=> 'Traiter les incidents, assister les utilisateurs, faire évoluer les services.',
                'icone'             => '🛠️',
                'ordre'             => 2,
                'sous_competences'  => [
                    'Collecter, suivre et orienter des demandes',
                    'Traiter des demandes concernant les services réseau et système',
                    'Traiter des demandes concernant les applications',
                ],
            ],
            [
                'slug'              => 'presence-en-ligne',
                'intitule'          => 'Développer la présence en ligne de l\'organisation',
                'intitule_court'    => 'Présence en ligne',
                'description_courte'=> 'Participer à la valorisation de l\'image de l\'organisation sur Internet.',
                'icone'             => '🌐',
                'ordre'             => 3,
                'sous_competences'  => [
                    'Participer à l\'évolution d\'un site Web exploitant les données de l\'organisation',
                    'Référencer les services en ligne de l\'organisation et mesurer leur visibilité',
                    'Participer à la valorisation de l\'image de l\'organisation sur les médias numériques',
                ],
            ],
            [
                'slug'              => 'mode-projet',
                'intitule'          => 'Travailler en mode projet',
                'intitule_court'    => 'Mode projet',
                'description_courte'=> 'Organiser un projet informatique : planification, collaboration, livrables.',
                'icone'             => '📋',
                'ordre'             => 4,
                'sous_competences'  => [
                    'Analyser les objectifs et les modalités d\'organisation d\'un projet',
                    'Planifier les activités',
                    'Évaluer les indicateurs de suivi d\'un projet',
                    'Gérer les ressources',
                ],
            ],
            [
                'slug'              => 'service-informatique',
                'intitule'          => 'Mettre à disposition des utilisateurs un service informatique',
                'intitule_court'    => 'Mise à dispo. service',
                'description_courte'=> 'Réaliser les tests, documenter, déployer et former sur un service.',
                'icone'             => '🚀',
                'ordre'             => 5,
                'sous_competences'  => [
                    'Réaliser les tests d\'intégration et d\'acceptation d\'un service',
                    'Déployer un service',
                    'Accompagner les utilisateurs dans la mise en place d\'un service',
                ],
            ],
            [
                'slug'              => 'developpement-professionnel',
                'intitule'          => 'Organiser son développement professionnel',
                'intitule_court'    => 'Dév. professionnel',
                'description_courte'=> 'Veille technologique, certifications, développement des compétences.',
                'icone'             => '📈',
                'ordre'             => 6,
                'sous_competences'  => [
                    'Mettre en place son environnement d\'apprentissage personnel',
                    'Mettre en œuvre des interactions entre services numériques',
                    'Exploiter les ressources du Web pour développer ses compétences professionnelles',
                ],
            ],
        ];

        foreach ($competences as $data) {
            $sousList = $data['sous_competences'];
            unset($data['sous_competences']);

            $comp = Competence::updateOrCreate(['slug' => $data['slug']], $data);

            foreach ($sousList as $sc) {
                SousCompetence::firstOrCreate([
                    'competence_id' => $comp->id,
                    'intitule'      => $sc,
                ]);
            }
        }
    }
}