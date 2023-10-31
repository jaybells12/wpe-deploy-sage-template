# WP Engine Example Sage Theme

<p align="center">
<img src="https://wpengine.com/wp-content/uploads/2020/08/WPE-LOGO-H-Default@3x.png" height="80px" style="padding-right: 40px;">
<img src="https://camo.githubusercontent.com/5f0b97ec47b3b185d642826e44b3750209c464c90e610372f55e5356e639c6c0/68747470733a2f2f63646e2e726f6f74732e696f2f6170702f75706c6f6164732f6c6f676f2d736167652e737667">
</p>

An example of how write beautiful and modern templates, with modern CI/CD practices using github actions and the Roots/Sage theme using [wpengine.com](https://wpengine.com)

To produce beautiful themes like
```blade
<a class="sr-only focus:not-sr-only" href="#main">
  {{ __('Skip to content') }}
</a>

<div class="flex flex-col h-screen">
  <div>
    @include('sections.header')
  </div>

  <main id="main" class="w-full max-w-6xl px-4 mx-auto mt-6 mb-auto">
    @yield('content')
  </main>

  @include('sections.footer')
</div>
```

## To get started
[Clone and modify this repo](#clone-this-repo) or [create a fresh install](./fresh.md)

## Clone this repo

1. First clone this repo with a sage theme
```bash
git clone https://github.com/jaybells12/wpe-deploy-sage-template <wordpress-dir>
cd <wordpress-dir>
```

2. Now, update the github action to use your info
```bash
vi .github/workflows/action.yml

# Edit this section
name: Deploy to WP Engine
env:
  WPE_SSHG_KEY_PRIVATE: ${{ secrets.WPE_SSHG_KEY_PRIVATE }} # Don't change this, leave the SSH key a secret
  WPE_INSTALL_NAME: your-wp-install-name
  THEME_NAME: your-roots-theme-name-here
```

3. Setup a new ssh private key in GithHub and public key in WP Engine via https://wpengine.com/support/github-action-deploy/#Setup_Instructions
  - This is __NOT__ done through GitPush

4. Push the repo to your own GitHub and the [post-deploy.sh](post-deploy.sh) will clear the cache during [GitHub deploys](.github/workflows/action.yml#L70) 🎉.

5. Run ```composer install``` from the theme's root directory
6. 
### Important: Windows users __must__ use [WSL](https://learn.microsoft.com/en-us/windows/wsl/install) for steps 6, 7, 8

6. Run ```yarn``` from the theme's root directory

7. Update [bud.config.js](./wp-content/themes/roots-theme/bud.config.js#L36) with your local dev URL and proxy

8. Run ```yarn build``` to compile assets.
