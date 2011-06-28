# Intro to mdox
`mdox` is a small program for generating documentation from Markdown. It comes with a nice template by default that you can easily update.

## Installation
Clone the repository to somewhere on your system. You can optionally symlink the `mdox` file to a $PATH location. If not, you will have to run it from the cloned directory all the time.

## Creating documentation
Navigate to the directory where your markdown documentation is stored. I recommend naming the files like 01-description.md, 02-other.md, 03-more.md and so on. mdox will create a nice Table of Contents based on this naming structure.

Create a file named `config.json` in the directory where your documentation is stored. It should look like this:

    {
      "title": "Replace with title of your project",
      "author": "Your or your company's name",
      "dest_output: "../html/"
    }

The `dest_output` directory is a directory **relative** to your source directory. It must exist before you run `mdox`.
