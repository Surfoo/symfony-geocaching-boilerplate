# Geocaching API with Symfony

## Configuration
Create the file `.env.dev.local` and copy the text below, with your own key and secret:

```
GEOCACHING_OAUTH_KEY=
GEOCACHING_OAUTH_SECRET=
```

## Docker

Run:

```
docker-compose up
```

And then, open:

```
http://localhost:8000
```

## SCSS builder

```
bin/console sass:build --watch
```