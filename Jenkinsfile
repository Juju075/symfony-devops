pipeline {
    agent {
        docker { image 'jenkins/jenkins:lts-jdk11'}
    }
    stages {
        stage('GitClone') {
            steps {
              git branch: 'main', url: 'https://github.com/Juju075/symfony-devops'
              //placer les fichiers dans .
            }
        }

        // Caching data for containers
        stage ('dc-up') {
            steps {
                    sh 'docker-compose up -d'
            }
        }
        //run from docker-compose
        stage ('Run') {
            steps {
                sh'docker-composr run '
            }
        }

    }
}
