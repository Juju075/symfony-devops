pipeline {
    agent {
        docker { image 'jenkins/jenkins:lts-jdk11'}
    }
    stages {
        // Placer les fichiers dans .
        stage('GitClone') {
            steps {
              git branch: 'main', url: 'https://github.com/Juju075/symfony-devops'
            }
        }

        // Caching data for containers
        stage ('dc-up') {
            steps {
              sh 'docker-compose up -d'
            }
        }

        //
        stage ('Tests') {
            steps {
              sh './vendor/bin/phpunit tests --colors -v –testdox'
              // quel test(s) ne marche pas
              // relancer ce test (logs)
            }
        }

        //
        stage ('DockerHub') {
            steps {

            }
        }
    }
}
