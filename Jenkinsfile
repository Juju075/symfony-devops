// Avoid trigger every time
pipeline {
//     agent {
//         docker { image 'node:16-alpine' }
//     }
        agent any
    stages {
        // Locate files in .
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

        // conditional result true continue or false stop pipeline
        stage ('Tests') {
            steps {
              sh './vendor/bin/phpunit tests --colors -v –testdox'
              // quel test(s) ne marche pas
              // relancer ce test (logs)
            }
        }

        //
        stage ('Pushing image') {
            steps {
                sh ''
            }
        }
        // jenkins in kubernetes [Kubernetes plugin]
        // kubernetes continue plugin
        stage ('Image deployment') {
            steps {
                script{
                    kubernetesDeploy(configs: "Deploymentservice.yml, kubeconfigId: "Kubernetes")
                }
            }
        }
        //
        stage ('deployment validation') {
            steps {}
            //cleanup
            steps {}
        }
    }
}
