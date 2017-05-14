tinymce.init({
  selector: 'textarea',
  plugins: 'codesample,link,preview,wordcount,save,code,image',
  codesample_languages: [
        {text: 'HTML/XML', value: 'markup'},
        {text: 'JavaScript', value: 'javascript'},
        {text: 'CSS', value: 'css'},
        {text: 'PHP', value: 'php'},
        {text: 'Ruby', value: 'ruby'},
        {text: 'Python', value: 'python'},
        {text: 'Java', value: 'java'},
        {text: 'C', value: 'c'},
        {text: 'C#', value: 'csharp'},
        {text: 'C++', value: 'cpp'}
    ],
  toolbar: 'codesample,link,preview,wordcount,undo,redo,formatselect,save,code,image',
  image_caption: true,
  image_prepend_url: "http://www.tinymce.com/images/"
});