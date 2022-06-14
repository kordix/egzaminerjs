String.prototype.escapeDiacritics = function () {
    return this.replace(/ą/g, 'a').replace(/Ą/g, 'A')
      .replace(/ć/g, 'c').replace(/Ć/g, 'C')
      .replace(/ę/g, 'e').replace(/Ę/g, 'E')
      .replace(/ł/g, 'l').replace(/Ł/g, 'L')
      .replace(/ń/g, 'n').replace(/Ń/g, 'N')
      .replace(/ó/g, 'o').replace(/Ó/g, 'O')
      .replace(/ś/g, 's').replace(/Ś/g, 'S')
      .replace(/ż/g, 'z').replace(/Ż/g, 'Z')
      .replace(/ź/g, 'z').replace(/Ź/g, 'Z')
      .replace(/ü/g, 'u').replace(/ú/g, 'u')
      .replace(/ö/g, 'o').replace(/é/g, 'e')
      .replace(/ä/g, 'a').replace(/í/g, 'i')
      .replace(/á/g, 'a').replace(/ö/g, 'o')
      .replace(/ß/g, 'ss')
      .replace(/ñ/g, 'n')
      ;
}
