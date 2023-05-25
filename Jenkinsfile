//Define the pipeline stages (like a pro) | Avoid trigger every time
pipeline {
//     agent {
//         docker { image 'node:16-alpine' }
//     }

        agent any

    stages {
        stage('GitClone') {
            steps {
              git branch: 'main', url: 'https://github.com/Juju075/symfony-devops'
            }
        }

        stage ('dc-up') {
            steps {
              sh 'docker-compose up -d'
            }
        }

        stage ('Tests') {
            steps {
              sh './vendor/bin/phpunit tests --colors -v –testdox'
              // quel test(s) ne marche pas
              // relancer ce test (logs)
            }
        }

        stage ("SonarQube") {
            steps {

            }
        }

        stage ('Pushing image') {
            steps {
                sh ''
            }
        }

    }
}
