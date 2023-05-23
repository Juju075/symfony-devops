//Define the pipeline stages (like a pro) | Avoid trigger every time
pipeline {
//     agent {
//         docker { image 'node:16-alpine' }
//     }

        agent any

    stages {
        //1- chekcout the source code  | Locate files in .
        stage('GitClone') {
            steps {
              git branch: 'main', url: 'https://github.com/Juju075/symfony-devops'
            }
        }
        //2- build app | Caching data for containers
        stage ('dc-up') {
            steps {
              sh 'docker-compose up -d'
            }
        }

        //3- run unit tests | conditional result true continue or false stop pipeline
        stage ('Tests') {
            steps {
              sh './vendor/bin/phpunit tests --colors -v –testdox'
              // quel test(s) ne marche pas
              // relancer ce test (logs)
            }
        }

        //4- run SonarQue | code quality SonaQube
        stage ("SonarQube") {
            steps {

            }
        }

        //5- package the app | create image dockerfile
        stage ('Pushing image') {
            steps {
                sh ''
            }
        }

      //6- deploy app to test env
      //7-
      //8- Argo CD
    }
}
