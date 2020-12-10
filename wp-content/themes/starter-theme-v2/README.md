# Starter Theme

## Running Gulp/PostCSS

No need to run `npm start` on your machine. Starting Lando runs a node container and watches everything by default.

If you want to follow the output, you can run `lando logs -f`. If you want to only see node, run `lando logs -s node -f`.

## Adding compiled files to repo

When you are ready to commit final compiled files to the repo, run `lando npm run build` and commit those final files.
