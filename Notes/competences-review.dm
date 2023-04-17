
Bugs correction
PHP Installation
////

---
Relation composition
Parent himself
---
Attributes ORM PHP8
_error/404

---
Fixtures

---

Routing controller
---
fonctionnement JWT token ( c super reloud utilise le bundle)
generation du token
decode du token
verification token
---
fonctionnement Recuperation mot de pass
---
Page error
composer require symfony/twig-pack
bundel/TwigBundel/Exception

---
Gestion des permissions avec les voters
Voter methode de restriction (Permission par action pour une methode )
vs authorisation par Role
Voters to Check User Permissions
https://writecode.fr/tutoriel/la-gestion-des-permissions-avec-les-voters
---
Administrateur sans bundle

---
FormType
createForm(FormType::class, $entity)

imbrication (list) category/product

---
Activation de cpt user  0 > 1
Sendmail  | register controller (service responsibility mailer)
Template mail de symfony
**
désactivation de messenger de symfony  (messenger.yaml)
#Symfony\Component\Mailer\Messenger\SendEmailMessage: async
---
Ajoute de service dans service.yaml
parameter string > appel

yam file validator
https://www.yamllint.com/
---

****
---
Custom repository (query-builder)
---
Form imbrique  list & query-builder

---
Form Button dynamique

<button type="submit">{{ button_label | default()}}</button>
{{ include "admin/products/_form.html.twig" with {'button_label': 'Modifier'} }

Use the with tag to create a new inner scope.
Variables set within this scope are not visible outside of the scope:
---
Form collection images
---

Astuces code
transfert de donne si meme signature

function  B(x) call return  A(x)

//
au lieu de if  pour un return
return Affirmation?     :bool
---
faire un ternaire au lieu d'un if/else
on peut faire un ternaire
---
Apprendre aussi custom QueryBuilder de DOCTRINE
https://www.doctrine-project.org/projects/doctrine-orm/en/2.14/reference/query-builder.html
createQueryBuilder()


'option_queryuilder' dans formulaire

