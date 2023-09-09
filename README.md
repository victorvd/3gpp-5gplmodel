# 3gpp-5gplmodel

## 3GPP-5G Path Loss Model

## How to build Docker image

```bash
docker buildx build --platform linux/amd64 -t 3gpp-5gplmodel:latest -f Docker/Dockerfile .
```

## How to use

```bash
docker run --rm -p 8080:8080 -d --name 3gpp-5gplmodel 3gpp-5gplmodel:latest
# open your browser
# http://localhost:8080
```

## How to deploy on self infrastructure

You can deploy self hosted 3GPP5GModel using docker-compose, Kubernetes manifests or Helm Charts.

### Using docker-compose

See `Docker/` folder content. This local deployment use Traefix to expose using HTTPS/TLS this application.
Adjust your own settings by edit `docker-compose.override.yml`.

```bash
cd Docker/
cp docker-compose.override-example.yml docker-compose.override.yml
code docker-compose.override.yml  # use your preferred editor
```

Start up 3GPP5GModel with

```bash
cd Docker/
docker-compose up -d
```

By default 3GPP5GModel run as non-root and read-only filesystem.

