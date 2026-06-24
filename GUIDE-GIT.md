# Guide Git pour le binome

Ce guide explique comment travailler a deux sur le meme projet sans s'ecraser.

## 1. Mise en place (une seule fois)

### Etudiant A (celui qui cree le depot)

```bash
cd gestion-eleves
git init
git add .
git commit -m "Premier commit - projet de base"
git branch -M main
git remote add origin https://github.com/TON_USER/gestion-eleves.git
git push -u origin main
```

Ensuite sur GitHub : **Settings > Collaborators > Add people** et ajouter
l'etudiant B avec son nom d'utilisateur GitHub.

### Etudiant B (le collaborateur)

Une fois l'invitation acceptee (un mail arrive) :

```bash
git clone https://github.com/TON_USER/gestion-eleves.git
cd gestion-eleves
```

## 2. Regle d'or : toujours travailler sur sa propre branche

On ne travaille **jamais** directement sur `main`. Chacun cree une branche
pour la fonctionnalite sur laquelle il travaille.

```bash
# Etudiant A
git checkout -b feature-recherche

# Etudiant B
git checkout -b feature-statistiques
```

## 3. Cycle de travail quotidien

```bash
# 1. Avant de commencer, recuperer les dernieres modifs
git checkout main
git pull origin main

# 2. Revenir sur sa branche (ou en creer une)
git checkout ma-branche

# 3. Travailler, puis enregistrer
git add .
git commit -m "Description claire de ce que j'ai fait"

# 4. Envoyer sa branche sur GitHub
git push origin ma-branche
```

## 4. Fusionner son travail (Pull Request)

1. Aller sur GitHub.
2. GitHub propose **Compare & pull request** -> cliquer.
3. base: `main`  <-  compare: `ma-branche`.
4. **Create pull request** puis **Merge pull request**.

## 5. Gerer un conflit

Un conflit arrive quand les deux ont modifie la **meme ligne** du **meme fichier**.
Git affiche alors dans le fichier :

```
<<<<<<< HEAD
ma version
=======
la version de l'autre
>>>>>>> branche
```

Il faut ouvrir le fichier, garder la bonne version, supprimer les marqueurs
`<<<<<<<`, `=======`, `>>>>>>>`, enregistrer, puis :

```bash
git add fichier-en-conflit
git commit -m "Resolution du conflit"
git push
```

## Recapitulatif des commandes utiles

| Commande                     | Effet                                  |
|------------------------------|----------------------------------------|
| `git status`                 | Voir l'etat des fichiers               |
| `git branch`                 | Lister les branches                    |
| `git checkout -b nom`        | Creer et aller sur une branche         |
| `git checkout nom`           | Changer de branche                     |
| `git pull origin main`       | Recuperer les modifs du depot          |
| `git push origin ma-branche` | Envoyer sa branche                     |
| `git log --oneline`          | Historique des commits                 |
