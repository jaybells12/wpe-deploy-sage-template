<p align="center">
  <img src="https://wpengine.com/wp-content/uploads/2020/08/WPE-LOGO-H-Default@3x.png" height="40px">
</p>

# Steps to recreate your own theme on your own github repo

1. [Create a wp engine site](https://my.wpengine.com/bulk_sites) if you don't already have one at wpengine.com. We'll use `"your-wp-install-name"` as an example.

2. Back on your machine, create your install directory that'll house the wordpress theme
```bash
mkdir your-wp-install-name && cd your-wp-install-name
```

3. Create the folder structure for the theme to ultimately be copied over
```bash
mkdir -p wp-content/themes && cd wp-content/themes
```

4. Within the themes directory, create your new theme using composer
```bash
composer create-project roots/sage your-roots-theme-name-here
```

5. With your new theme, you need acorn, the best way to install is also composer
```bash
cd your-roots-theme-name-here && composer require roots/acorn
```
### Important: Windows users __must__ use [WSL](https://learn.microsoft.com/en-us/windows/wsl/install) for steps 6, 7, 8

6. Run ```yarn``` from the theme's root directory to install dependencies

7. Update [bud.config.js](./wp-content/themes/roots-theme/bud.config.js#L36) with your local dev URL and proxy

8. Run ```yarn build``` to compile assets.

9. [Add "post-autoload-dump" script](https://github.com/jaybells12/wpe-deploy-sage-template/blob/main/wp-content/themes/your-roots-theme-name-here/composer.json#L63-L65) that'll run after every composer update command to the `composer.json`

10. Create the directory structure for the github action
```bash
mkdir -p .github/workflows/ && cd .github/workflows/
```

11. Add the github action that'll deploy the theme
```bash
wget https://github.com/jaybells12/wpe-deploy-sage-template/blob/main/.github/workflows/action.yml
```

12. Update just these sections of the `action.yml` file
```yml
name: Deploy to WP Engine
env:
  WPE_SSHG_KEY_PRIVATE: ${{ secrets.WPE_SSHG_KEY_PRIVATE }} # We'll add this later
  WPE_INSTALL_NAME: your-wp-install-name
  THEME_NAME: your-roots-theme-name-here
```

13. [Create and add an ssh-gateway private key](https://wpengine.com/support/ssh-gateway/#Create_SSH_Key) to [your repo's, or organization's, github secrets](https://wpengine.com/support/github-action-deploy/#Setup_Instructions) and the public key to [my.wpengine.com's](https://my.wpengine.com) user portal.

14. Add a [`post-deploy.sh`](./post-deploy.sh) script to run [wp-cli](https://wpengine.com/resources/on-demand-webinar-developers-bada-wp-cli/) commands like, `wp acorn view:cache` to compile the Sage templates once deployed.
```bash
cd ../../ && wget https://github.com/jaybells12/wpe-deploy-sage-template/blob/main/post-deploy.sh
```

15. And your done! With the action setup, it will now auto deploy and run the `post-deploy.sh` script. Just git commit and git push to your repo!

16. Secure access to blades using [WPEngine Redirect Rules](https://wpengine.com/support/redirect/) with this regex: ^/.*\.blade.php/?$
