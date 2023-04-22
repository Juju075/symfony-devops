pipeline {
    agent any
    stages {
        stage('Build') {
            steps {
                sh ''
            }
        }
        stage('Test') {
            steps {
                sh ''
            }
        }
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
    }
}
