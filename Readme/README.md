https://github.com/Juju075/symfony-devops/blob/kubernetes/Jenkinsfile



Declarative Jenkins Pipeline (Continuous Integration multiple stages )

//1- Checkout the source code  | Locate files in .<br>
//2- Build app | Caching data for containers<br>
//3- Run unit tests | conditional result true continue or false stop pipeline<br>
//4- Run SonarQue | code quality SonaQube<br>
//5- Package the app | create image dockerfile<br>
//6- Image scanning
//7- Push image registry
//8- Helm Charts (Update)
//9- Deploy app to test env<br>
//10-<br>
//8- Argo CD<br>

# PHP Unit
<img src="/public/images/1280px-PHPUnit_Logo.svg.png" height="80">

$ 

Tests architecture

# SonarQube
<img src="/public/images/sonarqube-logo-square-small.png" height="90">