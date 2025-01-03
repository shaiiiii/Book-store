pipeline {
    agent any

    stages {
        stage('Clone Repositories') {
            steps {
                echo 'Cloning the backend and frontend repositories...'
                script {
                    sh 'git clone -b backend https://github.com/shaiiiii/Book-store.git backend'
                    sh 'git clone -b frontend https://github.com/shaiiiii/Book-store.git frontend'
                }
            }
        }
        stage('Install Dependencies') {
            parallel {
                stage('Backend Dependencies') {
                    steps {
                        echo 'Installing dependencies for backend...'
                        dir('backend') {
                            bat 'C:/xampp/php/php.exe C:/ProgramData/ComposerSetup/bin/composer install --prefer-dist --no-dev --no-progress'
                        }
                    }
                }
                stage('Frontend Dependencies') {
                    steps {
                        echo 'Installing dependencies for frontend...'
                        dir('frontend') {
                            bat 'npm install'
                        }
                    }
                }
            }
        }
        stage('Run Build Commands') {
            parallel {
                stage('Backend Build Commands') {
                    steps {
                        echo 'Running Laravel build commands for backend...'
                        dir('backend') {
                            bat 'C:/xampp/php/php.exe artisan config:cache'
                            bat 'C:/xampp/php/php.exe artisan route:cache'
                            bat 'C:/xampp/php/php.exe artisan view:cache'
                        }
                    }
                }
                stage('Frontend Build Commands') {
                    steps {
                        echo 'Running build commands for frontend...'
                        dir('frontend') {
                            bat 'npm run build'
                        }
                    }
                }
            }
        }
        stage('Login to DockerHub') {
            steps {
                echo 'Logging in to DockerHub...'
                script {
                    withCredentials([usernamePassword(credentialsId: 'docker-hub-credentials', usernameVariable: 'DOCKER_USER', passwordVariable: 'DOCKER_PASS')]) {
                        bat '''
                        echo Logging into DockerHub...
                        docker login -u %DOCKER_USER% -p %DOCKER_PASS%
                        '''
                    }
                }
            }
        }
        stage('Build Docker Images') {
            parallel {
                stage('Backend Docker Image') {
                    steps {
                        echo 'Building Docker image for backend...'
                        dir('backend') {
                            script {
                                def backendImageTag = "shalani10502/book-keeper-backend:latest"
                                bat "docker build -t ${backendImageTag} ."
                            }
                        }
                    }
                }
                stage('Frontend Docker Image') {
                    steps {
                        echo 'Building Docker image for frontend...'
                        dir('frontend') {
                            script {
                                def frontendImageTag = "shalani10502/book-keeper-frontend:latest"
                                bat "docker build -t ${frontendImageTag} ."
                            }
                        }
                    }
                }
            }
        }
        stage('Push Docker Images') {
            parallel {
                stage('Push Backend Docker Image') {
                    steps {
                        echo 'Pushing backend Docker image to DockerHub...'
                        script {
                            def backendImageTag = "shalani10502/book-keeper-backend:latest"
                            bat "docker push ${backendImageTag}"
                        }
                    }
                }
                stage('Push Frontend Docker Image') {
                    steps {
                        echo 'Pushing frontend Docker image to DockerHub...'
                        script {
                            def frontendImageTag = "shalani10502/book-keeper-frontend:latest"
                            bat "docker push ${frontendImageTag}"
                        }
                    }
                }
            }
        }
    }

    post {
        success {
            echo 'Build and deployment completed successfully!'
        }
        failure {
            echo 'Build or deployment failed! Check the logs for more details.'
        }
    }
}
