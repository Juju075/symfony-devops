//Define the pipeline stages (like a pro) | Avoid trigger every time
pipeline {
//     agent {
//         docker { image 'node:16-alpine' }
//     }

        agent any

    stages {
        stage('Repository') {
            steps {
              git branch: 'main', url: 'https://github.com/Juju075/symfony-devops'
            }
        }

        stage ('Build') {
            steps {
              sh 'docker-compose up -d'
            }
        }

        stage ('Test') {
            steps {
              sh './vendor/bin/phpunit tests --colors -v –testdox'
              // quel test(s) ne marche pas
              // relancer ce test (logs)
            }
        }

        stage ('Quality') {
            steps {
                //SonarQube
            }
        }

        stage ('Package') {
            steps {
                sh ''
            }
        }

        //image scan

    }
}
