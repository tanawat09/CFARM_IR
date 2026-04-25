param(
    [Parameter(Mandatory = $true)]
    [string]$Registry,

    [string]$Tag = "v1",

    [string]$AppImageName = "cfarm-ir-app",

    [string]$WebImageName = "cfarm-ir-webserver",

    [switch]$Push
)

$Registry = $Registry.TrimEnd("/")
$appImage = "$Registry/$AppImageName`:$Tag"
$webImage = "$Registry/$WebImageName`:$Tag"

Write-Host "Building $appImage"
docker build -f docker/php/Dockerfile -t $appImage .
if ($LASTEXITCODE -ne 0) {
    exit $LASTEXITCODE
}

Write-Host "Building $webImage"
docker build -f docker/nginx/Dockerfile -t $webImage .
if ($LASTEXITCODE -ne 0) {
    exit $LASTEXITCODE
}

if ($Push) {
    Write-Host "Pushing $appImage"
    docker push $appImage
    if ($LASTEXITCODE -ne 0) {
        exit $LASTEXITCODE
    }

    Write-Host "Pushing $webImage"
    docker push $webImage
    if ($LASTEXITCODE -ne 0) {
        exit $LASTEXITCODE
    }
}

Write-Host ""
Write-Host "Use these values in Portainer:"
Write-Host "APP_IMAGE=$appImage"
Write-Host "WEBSERVER_IMAGE=$webImage"
