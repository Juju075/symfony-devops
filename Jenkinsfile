pipeline {
    agent any
    stages {

        //1- Récupère le code source à partir du dépôt Git
        stage('Checkout') {
              steps {
                // Récupère le code source à partir du repo Git
                checkout([$class: 'GitSCM',
                          branches: [[name: '*/master']],
                          doGenerateSubmoduleConfigurations: false,
                          extensions: [],
                          submoduleCfg: [],
                          userRemoteConfigs: [[url: 'https://github.com/nom-du-repo.git']]])
              }
        }

        //2- Compilation app
        stage('Build') {
            steps {
                sh 'composer install'
            }
        }

        //3- Test all features | Run cmd for:  all unit test PHP Unit
        stage('Test') {
            steps {
                sh 'vendor/bin/phpunit tests'
            }
        }

         //3- Analyse de code
         stage('Static Code Analysis') {
           steps {
             // Lance l'analyse de code statique avec SonarQube
             withSonarQubeEnv('Nom du serveur SonarQube') {
               sh 'mvn sonar:sonar'
             }
           }
         }

        //4- Deploiement sur namecheap
        stage('Deploy') {
            environment {
                DOCKER_REGISTRY = "my-registry"
                DOCKER_IMAGE_NAME = "my-app"
            }
            steps {
                sh 'docker build -t $DOCKER_REGISTRY/$DOCKER_IMAGE_NAME .'
                sh 'docker push $DOCKER_REGISTRY/$DOCKER_IMAGE_NAME'
            }
        }

        //6- Notification fin de processu par email list de destinataire
        stages {
            steps {
                sh 'notification'
            }
        }

    }
}
