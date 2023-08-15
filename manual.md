# Create post

All posts by default are located in the /posts/ directory of your website's server. The contents of this directory should follow the following hierarchy:

`/posts/%YEAR%/%MONTH%/%DAY%/%HOUR%_%MINUTE%.md`, where

- %YEAR% - the year of the post's publication (a four-digit number, for example: 2023),
- %MONTH% - the month of the post's publication (a two-digit number, for example: 07),
- %DAY% - the day of the post's publication (a two-digit number, for example: 05),
- %HOUR% - the hour of the post's publication (a two-digit number in 24-hour format, for example: 20),
- %MINUTE% - the minute of the post's publication (a two-digit number, for example: 45).

The `.md` extension at the end of the file is mandatory; otherwise, the engine will not recognize the post. If you need to hide a post, you can change the extension to any other or completely remove it.

# Markdown Tags

The engine uses Markdown markup to format text for posts on web pages. Standardized commonly used Markdown tags are used, but there may be minor changes. Examples of popular and commonly used tags are presented below.

## Titles:  
\# Title H1  
\## Title H2  
\### Title H3

## Links:  
\[Link with title](https://github.com/Sc00tFox/Blog "Link with title")  

\[Link without title](https://github.com/Sc00tFox/Blog)  

## Video:  
\!video[Title](URL or local path)  
- Example:  
\!video[Video example]\(/uploads/2023/07/05/hello.mp4)  
\!video[Video example]\(https://example.com/hello.mp4)  

## Audio with loop:  
\!audio[loop](URL or local path)  
- Example:  
\!audio[loop]\(/uploads/2023/07/05/hello.mp3)  
\!audio[loop]\(https://example.com/hello.mp3)  

## Audio without loop:  
\!audio[](URL or local path) 
- Example:  
\!audio[]\(/uploads/2023/07/05/hello.mp3)  
\!audio[]\(https://example.com/hello.mp3)  

## Quotes:  
\> Quote.  
\> Quote1.Quote2.Quote3.Quote4.  

## Image:  
\![Image name](URL or local path)  
- Example:  
\![Example image]\(/uploads/2023/07/05/hello.jpg)  
\![Example image]\(https://example.com/hello.jpg)  

## Text styles:  
\*italic*  

\*\*bold**  

\~~strikethrough~~  

\~~\*\*bold strikethrough**~~  

\~~\*italic strikethrough*~~  

\*\*\~~\*bold italic strikethrough*~~**  

## Code:  
\```python   
   print(f"Hello World!")  
\```

## Tables:  
Column | Column  
\------ | ------   
Cell   | Cell   

### Text Alignment  
- `:--` means the column is left aligned.
- `--:` means the column is right aligned.
- `:-:` means the column is center aligned.

## Lists:  
\- One  
\- Two  
\- Three  

Lists support hierarchy through indentation.