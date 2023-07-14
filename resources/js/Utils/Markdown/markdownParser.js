import { marked } from "marked";
import dompurify from "dompurify";
import hljs from "highlight.js";
import { markedHighlight } from "marked-highlight";

marked.use(
    markedHighlight({
        langPrefix: "hljs language-",
        highlight(code, lang) {
            const language = hljs.getLanguage(lang) ? lang : "plaintext";
            return hljs.highlight(code, {
                language,
            }).value;
        },
    })
);

export const markdownParser = (markdown) =>
    dompurify.sanitize(
        marked(markdown, {
            mangle: false,
            headerIds: false,
        })
    );
