pipeline {
    agent any
    stages {

        //1- Récupère le code source à partir du dépôt Git ds jenkins
        stage('Clone') {
              steps {
              git branch: 'main', url: 'https://github.com/Juju075/symfony-devops'
        }

        //2- Compilation app
        stage('Build') {
            steps {
                sh 'composer install'
            }
        }

        //3- Execute all app unit test | Run cmd for:  all unit test PHP Unit
        stage('Test') {
            steps {
                //sh 'vendor/bin/phpunit tests'
                sh'./vendor/bin/phpunit tests --colors -v –testdox'
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

        //4- Deploiement sur AWS
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
        // function mail
        stages {
            steps {
                sh 'notification'
            }
        }

    }
}
